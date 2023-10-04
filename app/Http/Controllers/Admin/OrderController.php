<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order ;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query();
        
        if($keyword = request('search')){
            $orders->where('id' , 'LIKE', "%$keyword%")->orWhere('tracking_serial' , $keyword);
        }

        $orders = $orders->where('status' , request('type'))->latest()->paginate(30);
        return view('admin.orders.all' , compact('orders')) ;
    }



    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $products = $order->products()->paginate(10);
        return view('admin.orders.details' , compact('products' , 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit' , compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required' , Rule::in(['unpaid' , 'paid' , 'preparation' , 'posted' , 'received' , 'canceled'])] ,
            'tracking_serial'=> 'required'
        ]);

        $order->update($data) ; 
        alert()->success('Order Edited SUCCESSFULLY' , 'Edition complete') ;
        return redirect(route('admin.orders.index') . "?type=$order->status") ;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        alert()->success('Order Deleted SUCCESSFULLY' , 'Delete complete') ;

        return back();
    }



    public function payment(Order $order)
    {

        $payments = $order->payments()->latest()->paginate(20) ;
        return view('admin.orders.payments' , compact('payments' , 'order'));
    }
}
