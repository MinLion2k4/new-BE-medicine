<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WareHouses;
class WareHouseController extends Controller
{
    //GET//all
    public function index()
    {
        return response()->json(WareHouses::all());
    }
    public function shore(Request $request){
        $request->validate([
            'product_id'=>'required',
            'stock'=>'required',
            'input_cost'=>'required',
            'input_date'=>'required|date',
        ]);
        $ware = new WareHouses();
        $ware->product_id = $request->product_id;
        $ware->stock = $request->stock;
        $ware->input_cost = $request->input_cost;
        $ware->input_date = $request->input_date;
        $ware->save();
        return response()->json($ware, 201);
    }
}
