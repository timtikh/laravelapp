<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $cart = \Cart::name('default');
        return view('cart.index')->with('cart', $cart);
    }

    public function create()
    {
        $cart = \Cart::name('default');

        \DB::transaction(function () use ($cart) {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'status' => "В обработке",
            ]);

            foreach ($cart->getItems() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->getId(),
                    'quantity' => $item->getQuantity()
                ]);
            }
        });

        return response()->redirectToRoute('order.index');
    }

    public function put(Request $request)
    {
        $productID = $request->integer('product_id');
        $product = Product::findOrFail($productID);

        $cart = \Cart::name('default');

        $cart->addItem([
            'id' => $product->id,
            'title' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
        ]);
        $product->quantity = $product->quantity - 1;

        return response()->redirectTo('cart');
    }

    public function remove(Request $request)
    {
        $id = $request->integer('product_id');
        $cart = \Cart::name('default');

        $cartItems = \Cart::getItems();
        //dd($request);
        // Ищем элемент корзины по id товара
        foreach ($cartItems as $cartItem) {
            if ($cartItem->getId() === $id) {
                if ($cartItem->getQuantity() == 1) {
                    $cart->removeItem($cartItem->getHash());
                } else {
                    $cart->updateItem($cartItem->getHash(), ['quantity' => $cartItem->getQuantity() - 1]);
                }
                break;
            }
        }

        return response()->redirectTo('cart');
    }
}
