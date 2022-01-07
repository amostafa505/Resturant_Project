<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Events\OrderEvent;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;


class CartController extends Controller
{
    public function addToCart(Product $product , $id){
        $product = Product::find($id);
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
        }
        $cart->add($product);
        // dd($cart);
        session()->put('cart' , $cart);
        toastr()->success('Done Add Product To Your Cart');
        return response()->json(["status"=>"success" , "Message"=>"Done Add the item in your Cart" , "totalQuantity" =>$cart->totalQty]);
    }
    public function showCart() {

            if (session()->has('cart')) {
                $cart = new Cart(session()->get('cart'));
            } else {
                $cart = null;
            }
    
            return view('layouts.Main.cart.show', compact('cart'));
    }

    public function checkout(){
        $amount = session('cart')->totalPrice;
        return view('layouts.Main.cart.checkout', compact('amount'));
    }

    public function update(Request $request , $id)
    {
        // dd(session());
        $request->validate([
           'qty' => 'required|numeric' 
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($id ,$request->qty);
        session()->put('cart',$cart);
        toastr()->success('Done Update item from your Cart');
        return response()->json(["status"=>"success" , "Message"=>"Done Update the item in your Cart" , "totalPrice"=>$cart->totalPrice , "totalQuantity" =>$cart->totalQty]);
    }


    public function destroy($id)
    {
        // dd($id);
        $cart = new Cart(session()->get('cart'));
        $cart->remove($cart->items[$id]);
        // dd($cart->totalPrice);

        if($cart->totalQty <= 0 ){
            session()->forget('cart');
        }else{
            session()->put('cart' , $cart);
        }
        return response()->json(["status"=>"success" , "Message"=>"Done remove the item from your Cart" , "totalPrice"=>$cart->totalPrice , "totalQuantity" =>$cart->totalQty]);
    }

    public function charge(Request $request){
        // dd(session('cart')->items);
        $charge = Stripe::charges()->create([
            'currency'  => 'USD',
            'source'    => $request->stripeToken,
            'amount'    => $request->amount,
            // 'description'=> 'test From laravel app'
        ]);
        //succssful
        $chargeId = $charge['id'];

        if($chargeId){
            //Add to orders Table
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'totalPrice' => $request->amount,
                'billing_address' => $request->address,
                'billing_email' => $request->email,
                'billing_phone' => $request->phone,
            ]);
            
            
            foreach(session('cart')->items as $item)
            {
                //Add to Order_product Table
                OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item['id'],
                    'quantity'=> $item['qty']
                ]);

                //this code for decrease the Dish Qty After a valid purchase 
                //also change the status if the qty is equal 0 or less to not active
                $product = Product::find($item['id']);
                $product->decrement('qty', $item['qty']);
                if($product->qty <= 0){
                    $product->status = 'notactive';
                    $product->save();
                }
            }
            //send an email to the User with his order
            event(new OrderEvent($order));

            //Remove the cart from Session and send a success Massage
            session()->forget('cart');
            toastr()->success('Payment Done Enjoy Your Meal');
            return redirect()->route('index');
        }else{
            toastr()->error('Please check your Information and Try Again!');
            return back();
        }
    }
}
