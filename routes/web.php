<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('adminDashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    Route::get('/enterasuser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');

    //Route::get('/category',[CategoryController::class,'index'])->name('adminCategories');
    //Route::get('/product',[ProductController::class,'index'])->name('products');

    Route::get('category/{category}/products',[CategoryController::class,'productList'])->name('productCategory');
    Route::resource('category',CategoryController::class, [
        'names' => [
            'index' => 'categories',
            'create' => 'categoryCreate',
            'update' => 'categoryUpdate',
            'store' => 'categorySave',
            'show' => 'categoryShow',
            'edit' => 'categoryEdit',
            'destroy' => 'categoryDelete',
        ]
    ]);

    Route::get('product/category-create/{category}',[ProductController::class,'createProductCategory'])->name('createProductCategory');
    Route::resource('product',ProductController::class, [
        'names' => [
            'index' => 'products',
            'create' => 'productCreate',
            'update' => 'productUpdate',
            'store' => 'productSave',
            'show' => 'productShow',
            'edit' => 'productEdit',
            'destroy' => 'productDelete'
        ]
    ]);

    /*
    Route::prefix('product')->group(function () {
        Route::get('/',[AdminController::class,'products'])->name('adminProducts');
    });
    */
});

Route::middleware('auth')->resource('profile', ProfileController::class)
    ->only(['update', 'show', 'destroy'])
    ->parameters(['profile' => 'user']);
