<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = Payment::all();
        $products = Product::all();

        return view('orders.create', compact('payments', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
          'user_id' => 1,
        ]);

        $dataOrder = $request->only('table_number', 'payment_id', 'user_id', 'total');
        $order = Order::create($dataOrder);

        $dataDetail = $request->only('product_id', 'quantity', 'subtotal');
        $countDetail = count($dataDetail['product_id']);

        for ($i=0; $i < $countDetail; $i++) {

            $detail               = new OrderDetail();
            $detail->order_id     = $order->id;
            $detail->product_id   = $dataDetail['product_id'][$i];
            $detail->quantity     = $dataDetail['quantity'][$i];
            $detail->subtotal     = $dataDetail['subtotal'][$i];
            $detail->save();
        }

        return redirect('/orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order    = Order::find($id);
        $payments = Payment::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'payments', 'products'));
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
        $request->merge([
          'user_id' => 1,
        ]);

        $dataOrder = $request->only('table_number', 'payment_id', 'user_id', 'total');
        $order = Order::find($id)->update($dataOrder);

        $dataDetail = $request->only('product_id', 'quantity', 'subtotal');
        $countDetail = count($dataDetail['product_id']);

        OrderDetail::where('order_id', $id)->delete();

        for ($i=0; $i < $countDetail; $i++) {

            $detail               = new OrderDetail();
            $detail->order_id     = $id;
            $detail->product_id   = $dataDetail['product_id'][$i];
            $detail->quantity     = $dataDetail['quantity'][$i];
            $detail->subtotal     = $dataDetail['subtotal'][$i];
            $detail->save();
        }

        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderDetail::where('order_id', $id)->delete();

        Order::find($id)->delete();

        return redirect('/orders');
    }
}
