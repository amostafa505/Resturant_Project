<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FoodMenu;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;


class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('foodmenu')->get();
        // dd($data);
        return view('layouts/products/show' , compact('data'))->with('id' , 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = FoodMenu::all();
        return view('layouts/products/add',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        $validated = $request->validated();
        $img = $this->saveImage($request);
        $validated['img'] = $img;
        Product::Create($validated);
        toastr()->success('Done Create New Product');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $menu = FoodMenu::get();
        return view('layouts/products/edit', compact('product' ,'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request)
    {
        $validated = $request->validated();
        $validated['img'] = $this->updateImage($request);
        Product::find($request->id)->update($validated);
        toastr()->success('Done Update This Product');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        unlink(public_path() .  '/images/products/' . $product->img);
        return response()->json(["status"=>"success" , "Message"=>"Deleted Succussfully"]);
    }

    public function saveImage($request){
        if($request->hasFile('img')){
            $file = $request->file('img');
            $exten = $file->getClientOriginalExtension();
            $newname = uniqid(). '.' .$exten;
            $destenationpath = 'images/products';
            $file->move($destenationpath , $newname);
            return $newname;
        }
    }

    public function updateImage($request){
        $data = Product::find($request->id);
        if($request->img){
            if(file_exists(public_path() .  '/images/products/' . $data->img)){
                unlink(public_path() .  '/images/products/' . $data->img);    
            }
            $img = $this->saveImage($request);
            $validated['img'] = $img;
        }else{
            $validated['img'] = $data->img;
        }
        return  $validated['img'];
    }
}
