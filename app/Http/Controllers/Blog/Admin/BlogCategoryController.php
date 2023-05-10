<?php

namespace App\Http\Controllers\Blog\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Blog\Admin\BaseCategoryController;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategories;
use Illuminate\Support\Str;

class BlogCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $blogCategories = BlogCategories::paginate(10);
        return view('blog.admin.category.index', compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BlogCategories $item)
    {
        
        $categoryList = BlogCategories::all();
        return view('blog.admin.category.edit', 
                    compact('item', 'categoryList' ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();  
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = new BlogCategories($data);
        $item->save();
        

        if($item) return redirect()->route('blog.admin.category.edit', $item->id);
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
         $item = BlogCategories::findOrFail($id);
         $categoryList = BlogCategories::all();

         return view('blog.admin.category.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, string $id)
    {       

            $item = BlogCategories::find($id);
            
            
            if(!$item) return back()->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                                     ->withInput();
            
            
            $data = $request->all();

            if(empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            
            $result = $item->update($data);
            //update включает метод fill & save
            // $result = $item->fill($data)
            //                 ->save();
            //второй способ
            //save возвращает bool
            
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
