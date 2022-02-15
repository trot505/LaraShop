<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;

class CartController extends Controller
{

    public function index(){
        $title = "Корзина";
        $products = $this->sessionProducts();
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

    public function createOrder(Request $request){

        $user = Auth::user();
        if(!$user){
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'address' => 'required|string',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            Auth::loginUsingId($user->id);

            $address = $user->addresses()->create([
                'address' => $request->input('address'),
                'main' => 1
            ]);
        } else {
            $request->validate([
                'address_id' => 'required',
            ]);
            $address = $user->addresses()->find($request->input('address_id'));
        }

        $products = $this->sessionProducts();
        $sum = round($products->sum('sum'),2);

        $prepare_products = array_combine($products->modelKeys(),$products->makeHidden([
            'id',
            'name',
            'category_id',
            'amount',
            'picture',
            'category'
        ])->toArray());

        $order = $user->orders()->create([
            'address' => $address->address,
            'sum' => $sum
        ]);

        $order->products()->attach($prepare_products);

        Mail::to($user->email)
            ->queue(new OrderCreated([
                'products' => $products,
                'totalSum' => $sum,
                'name' => $user->name,
                'address' => $address->address
            ]));

        foreach ($products as $product){
            $product->amount -= $product->quantity;
            unset($product->quantity, $product->sum);
            $product->save();
        }

        session()->forget('cart');

        return redirect()->route('order');
    }

    private function sessionProducts (){
        $cart_idx = session('cart') ?? [];
        return Product::with('category')->select(['id','name','category_id','price','amount','picture'])->find(array_keys($cart_idx))->map(function ($v) use ($cart_idx) {
            $v->quantity = $cart_idx[$v->id];
            $v->sum = round($cart_idx[$v->id] * $v->price,2,PHP_ROUND_HALF_UP);
            return $v;
        });
    }
}
