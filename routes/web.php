<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('save-file/{cls}',[FileController::class,'download'])->name('saveFile');
Route::get('load-file',[FileController::class,'saveFile'])->name('loadFile');

Route::get('category/{category}/products',[CategoryController::class,'productList'])->name('productCategory');
Route::resource('category',CategoryController::class, [
    'names' => [
        'index' => 'categories',
        'show' => 'categoryShow',
    ]
])->only([
    'index',
    'show'
]);

Route::resource('product',ProductController::class, [
    'names' => [
        'index' => 'products',
        'show' => 'productShow',
    ]
])->only([
    'index',
    'show'
]);

Route::resource('address',AddressController::class, [
    'names' => [
        'store' => 'addressSave',
        'update' => 'addressUpdate',
        'destroy' => 'addressDelete',
    ]
])
->only([
    'store',
    'update',
    'destroy'
]);

Auth::routes();

Route::middleware('auth')->resource('profile', ProfileController::class)
    ->only(['update', 'show', 'destroy'])
    ->parameters(['profile' => 'user']);

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('adminDashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    Route::get('/enterasuser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    //Route::get('/category',[CategoryController::class,'index'])->name('adminCategories');
    //Route::get('/product',[ProductController::class,'index'])->name('products');

    Route::resource('category',CategoryController::class, [
        'names' => [
            //'index' => 'categories',
            'create' => 'categoryCreate',
            'update' => 'categoryUpdate',
            'store' => 'categorySave',
            //'show' => 'categoryShow',
            'edit' => 'categoryEdit',
            'destroy' => 'categoryDelete',
        ]
    ])->only([
        'create',
        'update',
        'store',
        'edit',
        'destroy'
    ]);
    Route::get('product/category-create/{category}',[ProductController::class,'createProductCategory'])->name('createProductCategory');
    Route::resource('product',ProductController::class, [
        'names' => [
            //'index' => 'products',
            'create' => 'productCreate',
            'update' => 'productUpdate',
            'store' => 'productSave',
            //'show' => 'productShow',
            'edit' => 'productEdit',
            'destroy' => 'productDelete'
        ]
    ])->only([
        'create',
        'update',
        'store',
        'edit',
        'destroy'
    ]);

    Route::post('upload-file/{cls}',[FileController::class,'loading'])->name('uploadFile');
});
