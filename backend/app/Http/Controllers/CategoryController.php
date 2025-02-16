<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        // return view('category.index');
        $categories = Category::all();
        return view('category.index', ['categories'=> $categories]);
    }

    public function create(){
        return view('category.create');
    }

    public function postCategory(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'description'=>'nullable|string'
        ]);

        Category::create($data);

        return redirect(route('category.index'))->with('success','Category created successfully');
    }

    public function edit(Category $category){
        return view('category.edit',['category'=>$category]);
    }

    public function updateCategory(Category $category, Request $request){
        $data=$request->validate([
            'name'=>'required',
            'description'=>'nullable|string'
        ]);

        $category->update($data);

        return redirect(route('category.index'))->with('success','Category updated successfully');
    }
}