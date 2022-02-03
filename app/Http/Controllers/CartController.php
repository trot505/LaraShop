<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $title = "Корзина";
        $cart_idx = session('cart');
        $products = Product::with('category')->select(['id','name','category_id','price','amount','picture'])->find(array_keys($cart_idx))->map(function ($v) use ($cart_idx) {
            $v->quantity = $cart_idx[$v->id];
            $v->sum = round($cart_idx[$v->id] * $v->price,2,PHP_ROUND_HALF_UP);
            return $v;
        });

        return view('pages.cart', compact('products', 'title'));
    }

    public function addProductCart(Request $request){
        $this->addSession($request);
        return back();
    }

    public function updateProductCart(Request $request){
        $this->addSession($request);
        return back();
    }

    public function removeProductCart(int $id){
        session()->forget("cart.$id");
        return back();
    }

    private function addSession(Request $request){
        $id = $request->input('id');
        session(["cart.$id" => $request->input('quantity')]);
    }

}
