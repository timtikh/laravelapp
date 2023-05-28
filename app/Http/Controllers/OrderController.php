<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all()
            ->where('user_id', '=', auth()->user()->id);
        return view('orders.index', compact('orders'))
            ->with('orders', $orders);
    }

    public function store(Request $request) {
        $new_order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => "В обработке",
        ]);
        $order_id = $new_order->id;
        $cart = \Cart::name('default');
        $cart_items = $cart->getItems();
        foreach ($cart_items as $item) {
            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $item->getId(),
                'quantity' => $item->getQuantity(),
            ]);
        }
        $cart->clearItems();
        return redirect()->to('/orders');
    }
    public function destroy(Request $request) {
        $id = $request->integer('id');
        $order = Order::all()->where('id', '=', $id)->first();
        $order->delete();
        return redirect()->to('/orders');
    }
}
