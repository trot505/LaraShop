<?php

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

    Route::get('/category',[AdminController::class,'categories'])->name('adminCategories');
    Route::get('/product',[AdminController::class,'products'])->name('adminProducts');
    /*Route::prefix('category')->group(function () {
        Route::get('/',[AdminController::class,'categories'])->name('adminCategories');
    });

    Route::prefix('product')->group(function () {
        Route::get('/',[AdminController::class,'products'])->name('adminProducts');
    });
    */
});

Route::resource('profile', ProfileController::class)
    ->only(['update', 'show', 'destroy'])
    ->parameters(['profile' => 'user']);