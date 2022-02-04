<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $title = 'Мои заказы';
        $user = Auth::user();

        $orders = $user->orders()->with('products')->get();

        return view('pages.orders',compact('title', 'orders'));
    }

    public function repeatOrder(Order $order){
        $products = $order->products()->get();
        foreach ($products as $product){
            if($product->amount === 0) continue;
            session(["cart.{$product->id}" => $product->pivot->quantity]);
        }

        return redirect()->route('cart');
    }
}
