<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::with('user')->paginate(10);
        return view('layouts/orders/show' , compact('data'))->with('id' , 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::find($id)->products()->get();
        // dd($data);
        return view('layouts/orders/viewOrder' , compact('orders'))->with('id' , 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'status' => 'in:pending,shipped,canceled,rejected,accepted,pending'
        ]);

        $order = Order::find($id);
        $order->orderstatus = $request->status;
        $order->save();
        return response()->json(["status"=>"success"  , "Message"=>"Status Updates Succussfully" , "data"=>$order]);
        // $response['row'] = $order;
        // return back()->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::destroy($id);
        return response()->json(["status"=>"success" , "Message"=>"Deleted Succussfully"]);
    }

    public function filterByStatus($status)
    {
        $status = Order::where('orderstatus' , '=' , $status)->with('user')->get();
        // dd($status);
        return response()->json(["status"=>"success"  , "data"=>$status]);
    }
}
