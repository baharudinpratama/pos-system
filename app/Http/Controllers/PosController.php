<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        $orderDetails = OrderDetail::all();
        $totalPrice = OrderDetail::sum('subtotal');

        return view('main.pos.index', compact('products', 'orderDetails', 'totalPrice'));
    }

    public function storeOrder(Request $request)
    {
        $this->validate($request,[
            'product_id' => ['required', 'unique:order_details'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);
        
        $price = Product::select('price')->where('id', $request->product_id)->first()->price;
        $subtotal = $price * $request->quantity;

        $orderDetail = new OrderDetail;
        $orderDetail->product_id = $request->product_id;
        $orderDetail->quantity = $request->quantity;
        $orderDetail->subtotal = $subtotal;
        $orderDetail->save();
        
        return redirect()->route('pos');
    }

    public function deleteOrder($id)
    {
        OrderDetail::where('id', $id)->delete();

        return redirect()->route('pos');
    }

    public function confirmOrder()
    {
        $totalPrice = OrderDetail::sum('subtotal');
        
        $transaction = new Transaction;
        $transaction->cashier = Auth::user()->name;
        $transaction->total = $totalPrice;
        $transaction->save();

        $orderDetail = OrderDetail::get();
        
        foreach ($orderDetail as $key => $value) {
            $orders = array (
                'transaction_id' => $transaction->id,
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'subtotal' => $value->subtotal,
                'created_at' => \Carbon\carbon::now(),
                'updated_at' => \Carbon\carbon::now(),
            );

            Order::insert($orders);

            $stock = Product::select('stock')->where('id', $value->product_id)->first()->stock;
            $decreaseStock = $stock - $value->quantity;

            $product = Product::find($value->product_id);
            $product->stock = $decreaseStock;
            $product->save();

            OrderDetail::where('id', $value->id)->delete();
        }

        return redirect()->route('pos')->with('message', 'Transaction done');
    }
}
