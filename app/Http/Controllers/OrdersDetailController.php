<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrdersDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderdetails = OrderDetail::all();
        return response()->json($orderdetails);
    }
    public function show($id){
        $orderdetails = OrderDetail::where('order_id', $id)->get();
        return response()->json($orderdetails);
    }
    public function create(Request $request)
{
    $request->validate([
        'order_id' => 'required',
        'product_id' => 'required',
        'quantity' => 'required'
    ]);

    $orderdetail = OrderDetail::create($request->all());

    return response()->json($orderdetail, 200);
}
    public function edit($request,$id)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        $orderdetail = OrderDetail::find($id);
        $orderdetail->update($request->all());
        return response()->json($orderdetail,200);
    }

    public function destroy(string $id)
    {
        $orderdetail = OrderDetail::find($id);
        $orderdetail->delete();
        return response()->json(null, 204);
    }
}
