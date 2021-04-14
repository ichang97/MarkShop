<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AddressBookController;

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

Route::get('/', [IndexController::class, 'ShowIndex'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Products resource
Route::resource('products', ProductController::class);

//Product types resource
Route::resource('product_types', ProductTypeController::class);

//Add to cart route
Route::get('add_to_cart/{id}', [CartController::class, 'add_to_cart'])->name('add_to_cart');

//Show product in cart page
Route::get('carts', [CartController::class, 'ShowCart'])->name('show_cart');

//Update cart route
Route::patch('update_cart/{id}', [CartController::class, 'UpdateCart'])->name('update_cart');

//Delete cart route
Route::delete('delete_cart/{id})', [CartController::class, 'DeleteCart'])->name('delete_cart');

//Member resource
Route::resource('members', MemberController::class);

//Member login
Route::get('member_login', [MemberController::class, 'member_login'])->name('member_login');

//Member logout
Route::get('member_logout', [MemberController::class, 'member_logout'])->name('member_logout');

//Member view my profile
Route::get('my_profile', [MemberController::class, 'index'])->name('my_profile');

//Address Book resource
Route::resource('address_book', AddressBookController::class);