<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chef;
use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class cpanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = USER::all()->count();
        $chefs = chef::all()->count();
        $products = Product::all()->count();
        $menus = foodmenu::all()->count();
        $orders = Order::all()->count();
        return view('layouts/admin/index' , compact('users', 'chefs' , 'products' , 'menus' , 'orders'));
    }
   
}
