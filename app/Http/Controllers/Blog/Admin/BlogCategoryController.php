<?php

namespace App\Http\Controllers\Blog\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Blog\Admin\BaseCategoryController;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategories;
use Illuminate\Support\Str;
use App\Repositories\BlogCategoryRepository;



class BlogCategoryController extends BaseController
{
    /**
     *  @var BlogCategoryRepository
     */
 

    public function __construct()
    {
        parent::__construct();

    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $paginator = BlogCategoryRepository::getAllWithPaginate(8);

        return view('blog.admin.category.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     * Item is an empty array here !!
     */
    public function create(BlogCategories $item)
    {

        $categoryList = BlogCategoryRepository::getForComboBox();
        
        return view('blog.admin.category.edit', 
                    compact('item', 'categoryList' ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request): mixed
    {
        $data = $request->input();  
       

        $item = new BlogCategories($data);
        $item->save();


        if($item) return redirect()->route('blog.admin.category.edit', $item->id)
                            ->with(['success' => "Успешно сохранено"]);

        else back()->withErrors(['msg' => 'Ошибка сохранения в Store'])
                    ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo __METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $item = BlogCategoryRepository::getItem($id);
         if(empty($item)) {
                    abort('404');
         }
         $categoryList = BlogCategoryRepository::getForComboBox();

         return view('blog.admin.category.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, string $id)
    {       
            $item = BlogCategoryRepository::getItem($id);
            
            if(!$item) return back()->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                                     ->withInput();
            
            $data = $request->all();


            $result = $item->update($data);
            
            if($result) return redirect()
                                    ->route('blog.admin.category.edit', $item->id)
                                    ->with(['success' => "Успешно сохранено"]);
            else return back()
                            ->withErrors(['msg' => 'Ошибка сохранения'])
                            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
