<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FoodMenu;
use App\Models\productImage;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;
use Illuminate\Support\Facades\Storage;

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
        $cat = FoodMenu::with('products')->get();
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
        $product = Product::Create($validated);
        $images[] = $this->saveImage($request , $product->id);
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
        // $product = Product::where('id' , $id)->with('productImages')->get();

        $product = Product::with('productImages')->find($id);
        // $images = productImage::where('product_id', $id)->get();
        // dd($product);
        return view('layouts/products/view' , compact('product'));
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
        // $validated['image_id'] = $this->updateImage($request);
        if($request->image_id){
            $this->updateImage($request);
        }
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
        $product = Product::with('productImages')->find($product->id);
        $product->delete($product);
        foreach($product->productImages as $image){
            unlink(public_path() .  '/storage/images/products/' . $image->name);
            // File::delete('/images/products/'.$image->name);
        }
        return response()->json(["status"=>"success" , "Message"=>"Deleted Succussfully"]);
    }

    //this function i use it for saving images by storage first chage its name to make it unique 
    //then save it to the storage 
    public $newname=[];
    public function saveImage($request ,$id){
        if($request->hasFile('image_id')){
            $files = $request->file('image_id');
            foreach($files as $file){
                $exten = $file->getClientOriginalExtension();
                $imgnewname = uniqid(). '.' .$exten;
                $destenationpath = 'images/products';
                $file->storeAs($destenationpath , $imgnewname, 'public');
                $newname[] = $imgnewname;
            }
            foreach($newname as $image){
                $proimage = new productImage;
                $proimage->name = $image;
                $proimage->product_id = $id;
                $proimage->save();
            }
        }
    }
    public function updateImage($request){
        $data = productImage::where('product_id',$request->id)->get();
        if($request->image_id){
            // dd($data);
            foreach($data as $image){
                productImage::destroy($image->id);
                if(file_exists(public_path() .  '/storage/images/products/' . $image->name)){
                    unlink(public_path() .  '/storage/images/products/' . $image->name);    
                }
            }
            $this->saveImage($request , $request->id);
        }
        // else{
        //     $validated['image_id'] = $data->img;
        // }
        // return  $validated['image_id'];
    }
}
// public function saveImage($request){
//     if ($request->has('image_id'))
//     {
//         $product_image = [];
//         $destenationpath = 'images/products';
//         foreach ($request->file('image_id') as $key => $file)
//         {
//             $image = Storage::put($destenationpath , $file);
//             if ($image)
//                 array_push($product_image, $image);
//         }
//         $fileNameToStore = serialize($product_image);
//     }
//     else
//     {
//         $fileNameToStore='noimage.jpg';
//     }
//     // $promotion = new productImage;
//     // $promotion->promotion_image = $fileNameToStore;
//     // $promotion->save();
//     return $fileNameToStore;
// }
