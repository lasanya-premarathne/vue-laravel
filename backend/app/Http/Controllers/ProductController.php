<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function getProducts(): JsonResponse
    {
        try {
            $products = Product::with('category')->get();
            return response()->json($products);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching products', 'message' => $e->getMessage()], 500);
        }
    }

    public function postProduct(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'unit_price' => 'required|numeric',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id', // Ensure category exists
            ]);

            Product::create($data);
            
            return response()->json(['message' => 'Product created successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the product', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateProduct(Product $product, Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'unit_price' => 'required|numeric',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id', // Ensure category exists
            ]);

            $product->update($data);

            return response()->json(['message' => 'Product updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the product', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteProduct(Product $product): JsonResponse
    {
        try {
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the product', 'message' => $e->getMessage()], 500);
        }
    }
}