<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimonialController;

use Illuminate\Container\Attributes\Tag;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.product.details');
Route::middleware('auth')->get('/carts', [FrontController::class, 'carts'])->name('front.carts');
Route::get('/products', [FrontController::class, 'productList'])->name('front.product');
Route::get('/location', [FrontController::class, 'location'])->name('front.location');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::resource('carts', CartController::class)->middleware('role:buyer');
    Route::post('carts/add/{productId}', [CartController::class, 'store'])->middleware('role:buyer')->name('carts.store');

    Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner|buyer');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        Route::resource('transactions', ProductTransactionController::class)->middleware('role:owner');
        Route::resource('tags', TagController::class)->middleware('role:owner');

        Route::resource('testimonials', TestimonialController::class)->middleware('role:buyer');



        // Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index')->middleware('role:buyer');
        // Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create')->middleware('role:buyer');
        // Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store')->middleware('role:buyer');
        // Route::put('testimonials/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit')->middleware('role:buyer');
        // Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
        // Route untuk filter produk berdasarkan kategori
        // Route::get('/category/{category}', [FrontController::class, 'filterByCategory'])->name('front.search');
    });
});

require __DIR__ . '/auth.php';
