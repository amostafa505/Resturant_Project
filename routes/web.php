<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\FoodMenusController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\chefController;
// use App\Http\Controllers\contactController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\cpanelController;
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

// Route::get('/', function () {
//     return view('layouts.Main.index');
// });

// route::group(['middleware'=>'auth'],function(){
//     route::group([
//         // 'namespace'=>'Admin',
//         // 'prefix' => 'admin',
//         'middleware' => 'is_admin',
//         'as' => 'admin'
//     ], function(){
//         Route::get('admin', function () {
//             return view('layouts/admin/index');
//         });
//         Route::resource('user' , UsersController::class);

//     });

// });

// Here To Make Only the admin users who can enter this group of URL's
route::middleware('auth' , 'is_admin')->group(function(){
    Route::get('cpanel' , "\App\Http\Controllers\cpanelController@index")->name('cpanel');
    Route::resource('users' , UsersController::class);
    Route::Resource('menus' , FoodMenusController::class);
    Route::Resource('chefs' , chefController::class);
    Route::Resource('products' , ProductsController::class);
});
require __DIR__.'/auth.php';

//This Route is for the Contact Form in the footer of all pages 
Route::post('contact', ['url' => 'contact', 'uses' =>
    '\App\Http\Controllers\contactController@sendcontact'])->name('contact.send');


// Here is the Route of the WebSite    
Route::get('/' , "\App\Http\Controllers\HomeController@index")->name('index');
Route::get('/menu' , "\App\Http\Controllers\HomeController@menu")->name('menu');
Route::get('/gallary' , "\App\Http\Controllers\HomeController@gallary")->name('gallary');
Route::get('/chef' , "\App\Http\Controllers\HomeController@chef")->name('chef');
Route::get('/contact' , "\App\Http\Controllers\HomeController@contact")->name('contact');