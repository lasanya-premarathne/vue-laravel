<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Exception;

class CategoryController extends Controller
{
    // to render the blades
    public function index(){
        return view('category.index');
    }

    public function create(){
        return view('category.create');
    }
    
    public function edit(Category $category){
        return view('category.edit',['category'=>$category]);
    }
    
    // apis
    public function getCategories() {
        try {
            $categories = Category::all();
            return response()->json($categories);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching categories', 'message' => $e->getMessage()], 500);
        }
    }

    public function postCategory(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'nullable|string'
            ]);

            Category::create($data);
            return response()->json(['message' => 'Category created successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the category', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateCategory(Category $category, Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'nullable|string'
            ]);

            $category->update($data); // some predefined function

            return response()->json(['message' => 'Category updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the category', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteCategory(Category $category) {
        try {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the category', 'message' => $e->getMessage()], 500);
        }
    }
}
 