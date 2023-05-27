<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostCreateRequest;
use App\Models\BlogCategories;
use Illuminate\Support\Str;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostsCreatedJob;
use App\Jobs\BlogPostsDeletedJob;
use App\Jobs\GenerateCatalog\GenerateCategoriesJob;
use App\Models\BlogPosts;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BlogPostsRepository;
use Illuminate\Support\Carbon;
use App\Repositories\BlogCategoryRepository;

class BlogPostController extends BaseController
{



    public function __construct()
    {
        parent:: __construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = BlogPostsRepository::getAllWithPaginate(15);

        $collection = collect(BlogPosts::all());
        $collection->transform(function( $item) {

                $item['published_at'] = Carbon::parse($item['published_at']);
                return $item;
        });

        $result = $collection->map(function($item) {
            $item['day'] = $item->created_at->day;
            $item['hours'] = $item->created_at->hour;
            return $item;
        });


        return view('blog.admin.posts.index', compact('paginator'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(BlogPosts $item)
    {
        // create $item just for the sake of using the same View as Edit method
        $categoryList = BlogCategoryRepository::getForComboBox();
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostCreateRequest $request)
    {

        $data = $request->input();
        $item =  BlogPosts::create($data);

        if($item) {
            // dispatch(new BlogPostsCreatedJob($item)); //send to queue
            BlogPostsCreatedJob::dispatch($item)->delay(20);
        }

        if($item) return to_route('blog.admin.posts.edit', $item->id)
                            ->withInput()
                            ->with(['success' => 'Добавлено']);

        else back()->withErrors(['msg' => 'Ошибка сохранения'])
                    ->withInput();
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $item = BlogPostsRepository::getItem($id);
        
         if(empty($item)) {
                    abort('404');
         }
         
         $categoryList = BlogCategoryRepository::getForComboBox();

         return view('blog.admin.posts.edit', compact('item','categoryList'));
    }


    
    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostUpdateRequest $request, string $id)
    {   

        $item = BlogPostsRepository::getItem($id);
        
        if(empty($item)) return back()->withErrors(['msg' => `Запись с ID{$id} не найдена` ])
                                      ->withInput();
 
        $data = $request->all();
        $result = $item->update($data);
        //returns bool
        if($result) return to_route('blog.admin.posts.edit', $item)
                            //If you are redirecting to a route with an "ID" 
                            //parameter that is being populated from an Eloquent model,
                            // you may pass the model itself. The ID will be extracted automatically ($item)
                                ->with(['success' => 'Успешно сохранено']);

        else return back()
                        ->withInput()
                        ->withErrors(['msg' => 'Ошибка сохранения']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //soft delete
        $result = BlogPosts::destroy($id);
        //delete from DB
        // $result = BlogPosts::withTrashed()->delete();

        if($result) {
            BlogPostsDeletedJob::dispatch($id);
            
            return to_route('blog.admin.posts.index')
                    ->with([
                            'success' => 'Успешно удалено',
                            'trashedId' => $id
                            ]);
        } else {
            return back()->withErrors(['msg' => 'Что-то пошло не так']);

    }
    }



    public function restore(string $trashedId)
    {
        $result = BlogPosts::withTrashed()->find($trashedId)->restore();

        if($result) return redirect()
                    ->route('blog.admin.posts.index')
                    ->with(['success' => 'Восстановлено']);

        else return back()->withErrors(['msg' => 'Что-то пошло не так']);
    }





    public function testQueueChain()
    {
        GenerateCategoriesJob::dispatch();
    }



}
