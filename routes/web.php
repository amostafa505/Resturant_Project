<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\FoodMenusController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\chefController;
use App\Http\Controllers\HomeController;
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
route::middleware('auth' , 'is_admin')->group(function(){
    Route::get('cpanel' , function () {
        return view('layouts/admin/index');
    });
    Route::resource('users' , UsersController::class);
    Route::Resource('menus' , FoodMenusController::class);
    Route::Resource('chefs' , chefController::class);
    Route::Resource('products' , ProductsController::class);
});
require __DIR__.'/auth.php';

Route::post('contact', ['url' => 'contact', 'uses' =>
    '\App\Http\Controllers\HomeController@sendcontact'])->name('contact.send');

Route::get('/' , "\App\Http\Controllers\HomeController@index")->name('index');
Route::get('/menu' , "\App\Http\Controllers\HomeController@menu")->name('menu');
Route::get('/gallary' , "\App\Http\Controllers\HomeController@gallary")->name('gallary');
Route::get('/chef' , "\App\Http\Controllers\HomeController@chef")->name('chef');
Route::get('/contact' , "\App\Http\Controllers\HomeController@contact")->name('contact');