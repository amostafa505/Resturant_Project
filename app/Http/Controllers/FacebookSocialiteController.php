<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookSocialiteController extends Controller
{
    public function redirectTofacebook(){
        return Socialite::driver('facebook')->redirect();
    }


    public function handleCallback(){
        $user = Socialite::driver('facebook')->user();
        $finduser = User::where('social_id', $user->id)->first();
  
        if($finduser){
  
            Auth::login($finduser);
 
            return back();
  
        }else{
            // dd($user->avatar);
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id'=> $user->id,
                'avatar'=> $user->avatar,
                'social_type'=> 'facebook',
                'password' => encrypt('my-facebook')
            ]);
 
            Auth::login($newUser);
  
            return redirect()->to('https://resturant-laravel.herokuapp.com/');
        }
    }
}
