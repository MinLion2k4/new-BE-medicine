<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeProducts;

class TypeProductsController extends Controller
{
    //GET//types
    public function index(){
        $type_products = TypeProducts::all();
        return response()->json($type_products);
    }
    //GET//types/{id}
    public function show($id){
        $type_products = TypeProducts::find($id);
        return response()->json($type_products);
    }
    //POST//types/create
    public function store(Request $request){
        try{
        $request->validate([
            'id' => 'required|string|max:10',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);
        $type_products = new TypeProducts();
        $type_products->id = $request->id;
        $type_products->name = $request->name;
        $type_products->description = $request->description;
        $type_products->save();
        return response()->json($type_products,201);
    }
    catch(\Exception $e){
        return response()->json([
            'message' => 'Error: '.$e
        ],400);
    }
    }
    //PATCH//types/update/{id}
    public function update(Request $request,$id){
        try{
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);
        $type_products = TypeProducts::findorFail($id);
        $type_products->id = $request->id;
        $type_products->name = $request->name;
        $type_products->description = $request->description;
        $type_products->save();
        return response()->json($type_products,201);
    }
    catch(\Exception $e){
        return response()->json([
            'message' => 'Error: '.$e
        ],400);
    }
    }
    //DELETE//types/delete/{id}
    public function delete($id){
        try{
        $type_products = TypeProducts::findorFail($id);
        $type_products->delete();
        return response()->json([
            'message' => 'Type deleted'
        ],201);
    }
    catch(\Exception $e){
        return response()->json([
            'message' => 'Error: '.$e
        ],400);
    }
    }
}
