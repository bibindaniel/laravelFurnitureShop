<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Blog;

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
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/contact', [UserController::class, 'submitContactForm'])->name('submitContactForm');
Route::post('/blog', [BlogController::class, 'submitBlogForm'])->name('submitBlogForm');
Route::post('/shop', [UserController::class, 'store'])->name('razorpay.payment.store');

Route::get('/paymentsuccess', function () {
    return view('paymentsuccess');
});
Route::get('/shop', function () {
    $product = Product::all();
    return view('shop')->with('item', $product);
})->name('shop');
Route::get('/main', function () {
    $recentBlogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
    $recentProducts = Product::take(3)->get();

    return view('main')->with([
        'blogs' => $recentBlogs,
        'products' => $recentProducts,
    ]);
})->name('main');
Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    $product = Product::take(3)->get();
    return view('services')->with('item', $product);
});
Route::get('/contact', function () {
    return view('contact');
});





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




// Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');
Route::get('/editblog/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('/blog', function () {
    $blog = Blog::all();
    return view('blog')->with('item', $blog);
});
Route::get('/detailedblog/{id}', function ($id) {
    $blog = Blog::find($id);
    return view('detailedblog')->with('blog', $blog);
})->name('detailedblog');
Route::put('/editblog/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/editblog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
