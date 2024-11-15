<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
       $request -> validate([
        'order_date' => 'required',
        'full_name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'total_price' => 'required',
        'status' => 'required',
       ]);
        $order = Order::create($request->all());
        return response()->json($order,201);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $request -> validate([
            'order_date' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'total_price' => 'required',
            'status' => 'required',
        ]);
        $order->order_date = $request->order_date;
        $order->full_name = $request->full_name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        return response()->json($order,200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return response()->json('deleted');
    }
    
}
