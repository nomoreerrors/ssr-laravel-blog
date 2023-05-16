<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use Illuminate\Support\Str;
use App\Http\Requests\BlogPostUpdateRequest;
use Illuminate\Http\Request;
use App\Repositories\BlogPostsRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Facades\Redirect;

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
        $paginator = BlogPostsRepository::getAllWithPaginate(5);
        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
 

        // $item = BlogPostsRepository::getItem($id);
        
        // if(empty($item)) return back()->withErrors(['msg' => `Запись с ID{$id} не найдена` ])
        //                               ->withInput();

        // $data = $request->all();
        // $data['excerpt'] = Str::excerpt($data['content_html']);
        // $data['slug'] = Str::slug($data['title']);



        // $result = $item->update($data);

        // if($result) return redirect()
        //                     ->route('blog.admin.posts.edit', $item->id)
        //                     ->with(['success' => 'Успешно сохранено']);

        // else return back()
        //                 ->withInput()
        //                 ->withErrors(['msg' => 'Ошибка сохранения']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
