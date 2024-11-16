<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\TypeProducts;

class ProductsController extends Controller
{
    //GET//ALL PRODUCTS
    public function index()
    {
        return response()->json(Products::all());
    }
    //GET//PRODUCTS BY ID
    public function show($id)
    {
        $product = Products::find($id);
        if ($product) {
            return response()->json($product);
        }
    }
    //POST//CREATE PRODUCT
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'other_name' => 'required|string|max:50',
                'scientific_name' => 'required|string|max:50',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'origin' => 'required|string|max:50',
                'expiry' => 'required|date',
                'image' => 'required|string',
                'category_id' => 'required|string|max:50',
            ]);
            $product = new Products();
            $product->name = $request->name;
            $product->other_name = $request->other_name;
            $product->scientific_name = $request->scientific_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->origin = $request->origin;
            $product->expiry = $request->expiry;
            $product->image = $request->image;
            $product->category_id = $request->category_id;
            $product->save();
            return response()->json($product, 201);
        } catch (\Exception $e) {
            Log::error('Error creating account: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'Error: ' . $e
            ], 400);
        }
    }
    //PATCH//UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'other_name' => 'required|string|max:50',
                'scientific_name' => 'required|string|max:50',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'origin' => 'required|string|max:50',
                'expiry' => 'required|date',
                'image' => 'required|text',
                'category_id' => 'required|string|max:50',
            ]);

            $product = Products::findOrFail($id);

            // Cập nhật các thuộc tính
            $product->name = $request->name;
            $product->other_name = $request->other_name;
            $product->scientific_name = $request->scientific_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->origin = $request->origin;
            $product->expiry = $request->expiry;
            $product->image = $request->image;
            $product->category_id = $request->category_id;

            // Lưu bản ghi sau khi cập nhật
            $product->save();

            return response()->json([
                'message' => 'Product updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    // CHANGE STOCK
    public function updateStock(Request $request, $id)
    {
        try {
            $request->validate([
                'stock' => 'required|numeric',
            ]);

            $product = Products::findOrFail($id);

            // Cập nhật các thuộc tính
            $product->stock = $request->stock;

            $product->save();

            return response()->json([
                'message' => 'Product updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    //DELETE//DELETE PRODUCT
    public function delete($id)
    {
        try {
            $product = Products::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Product deleted'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e
            ], 400);
        }
    }
    public function searchByName(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ tham số 'name' trong request
        $name = $request->input('name1');
        if (!$name) {
            return response()->json(['error' => 'Name parameter is required'], 400); // Trả về lỗi nếu không có tên
        }
        // Tìm kiếm sản phẩm theo tên có chứa từ khóa
        $products = Products::where('name', 'like', '%' . $name . '%')
            ->orWhere('other_name', 'like', '%' . $name . '%')
            ->orWhere('scientific_name', 'like', '%' . $name . '%')
            ->select('name', 'other_name', 'scientific_name', 'price', 'stock', 'origin', 'expiry','image', 'category_id')
            ->get();
            //dd($name);
        // Trả về kết quả dưới dạng JSON
        return response()->json($products,201);
    }
    public function searchByDisease(Request $request)
{
    $disease = $request->input('disease');
    if (!$disease) {
        return response()->json(['error' => 'Disease parameter is required'], 400);
    }
    $types = TypeProducts::where('description', 'like', '%' . $disease . '%')
        ->get();

    if ($types->isEmpty()) {
        return response()->json(['message' => 'No types found for the given disease'], 404);
    }
    $productIds = $types->pluck('id');

    $products = Products::whereIn('category_id', $productIds)
        ->get();

    // Trả về kết quả dưới dạng JSON
    return response()->json($products);
}
}
