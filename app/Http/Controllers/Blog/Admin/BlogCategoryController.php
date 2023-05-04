<?php

namespace App\Http\Controllers\Blog\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Blog\Admin\BaseCategoryController;
use App\Models\BlogCategories;

class BlogCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $blogCategories = BlogCategories::paginate(5);
        return view('blog.admin.category.index', compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo __METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo __METHOD__;
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
    public function update(Request $request, string $id)
    {
        $item = BlogCategories::findOrFail($id);
        $categoryList = BlogCategories::all();
        return view('blog.admin.category.update', compact('item','categoryList'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
