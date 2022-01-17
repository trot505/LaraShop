<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index (){
        $title = 'Старница админки';
        return view('admin.index', compact('title'));
    }

    function users (){
        $users = User::all();

        $title = 'Спсиок пользователей';
        return view('admin.users', compact('title', 'users'));
    }

    function enterAsUser($id){
        Auth::loginUsingId($id);
        return view('home');
    }

    function categories(){
        $categories = Category::all();

        $title = 'Спсиок категорий';
        return view('admin.categories', compact('title', 'categories'));
    }

    function products(){
        $products = Product::all();

        $title = 'Спсиок товаров';
        return view('admin.products', compact('title', 'products'));
    }
}
