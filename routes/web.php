<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\chefController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
// use App\Http\Controllers\contactController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\cpanelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FoodMenusController;


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


// Here To Make Only the admin users who can enter this group of URL's
route::middleware('auth' , 'is_admin')->group(function(){
    Route::get('cpanel' , "\App\Http\Controllers\cpanelController@index")->name('cpanel');
    Route::resource('users' , UsersController::class);
    Route::Resource('menus' , FoodMenusController::class);
    Route::Resource('chefs' , chefController::class);
    Route::Resource('products' , ProductsController::class);
    Route::Resource('orders' , OrdersController::class);
});
require __DIR__.'/auth.php';

//This Route is for the Contact Form in the footer of all pages 
Route::post('contact', ['url' => 'contact', 'uses' =>
    '\App\Http\Controllers\contactController@sendcontact'])->name('contact.send');


// Here is the Route of the WebSite    
Route::get('/' , "\App\Http\Controllers\HomeController@index")->name('index');
Route::get('/productpreview/{id}', "\App\Http\Controllers\HomeController@productview")->name('productpreview');
Route::get('/menu' , "\App\Http\Controllers\HomeController@menu")->name('menu');
Route::get('/gallary' , "\App\Http\Controllers\HomeController@gallary")->name('gallary');
Route::get('/chef' , "\App\Http\Controllers\HomeController@chef")->name('chef');
Route::get('/contact' , "\App\Http\Controllers\HomeController@contact")->name('contact');

//Cart & Orders Routes 
Route::get('/addtocart/{id}' , "\App\Http\Controllers\CartController@addToCart")->name('add.cart');
Route::get('/showcart' , "\App\Http\Controllers\CartController@showCart")->name('show.cart');
Route::get('/checkout/{amount}' , "\App\Http\Controllers\CartController@checkout")->name('cart.checkout')->middleware('auth');
Route::post('/charge' , "\App\Http\Controllers\CartController@charge")->name('cart.charge');
Route::delete('/carts/{cart}',"\App\Http\Controllers\CartController@destroy")->name('cart.remove');
Route::Put('/carts/{cart}',"\App\Http\Controllers\CartController@update")->name('cart.update');