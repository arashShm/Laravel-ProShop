<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\User ;
use Illuminate\Support\Str ;
use Illuminate\Console\View\Components\Alert ;

class GoogleAuthController extends Controller
{
    
    use TwoFactorAuthenticate;

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback(Request $request)
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email' , $googleUser->email)->first();



            if(! $user){
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)),
                    'two_factor_type' => 'off'
                ]);
            }


            if(! $user->hasVerifiedEmail()){
                $user->markEmailAsVerified();
            }


            auth()->loginUsingId($user->id) ;

            return $this->loggendIn($request , $user) ?: redirect('/home');


        } catch (\Exception $e) {
            alert()->error('Login Failed!','Login with Google Account Failed');
            return redirect('/login') ;
        }
    }



}
