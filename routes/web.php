<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('showRegistrationForm');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/create-post', [PostController::class, 'Create_post'])->name('CreatePost');
Route::get('/main', [UserController::class, 'mainPage'])->name('mainPage');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



Route::post('/store', [ProductController::class, 'store'])->name('store');
// Route::get('/main', [ProductController::class, 'index'])->name('main');
Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('update');
//admin
Route::get('/admin.main', [UserController::class, 'showDashboard'])->name('adminDashboard');
// Route::get('/admin.products', [UserController::class, 'products'])->name('products');
Route::get('/admin.create', [ProductController::class, 'create'])->name('create');
Route::get('/admin.products', function () {
    $product = Product::all();
    return view('admin.products')->with('item', $product);
})->name('admin.products');
Route::get('/admin.edit/{id}', [ProductController::class, 'edit'])->name('edit');
Route::delete('/admin.delete/{id}', [ProductController::class, 'destroy'])->name('delete');

