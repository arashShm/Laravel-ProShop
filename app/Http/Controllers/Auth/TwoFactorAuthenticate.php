<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use App\Notifications\LoginToSiteNotification;

trait TwoFactorAuthenticate
{
    public function loggendIn(Request $request, $user)
    {
        if($user->hasTwoFactorAuthenticatedEnabled()){
            return $this->logoutAndRedirectToTwoFactorEntry($request , $user) ;
        }

        $user->notify(new LoginToSiteNotification());
        return false ;
    }





    public function logoutAndRedirectToTwoFactorEntry(Request $request ,$user)
    {
        auth()->logout() ;

        $request->session()->flash('auth' , [
            'user_id' => $user->id ,
            'using_sms' => false ,
            'remember' => $request->has('remember')
        ]);





        if($user->hasSmsTwoFactorAuthenticationEnabled()){

            $code = ActiveCode::generateCode($user);
            $user->notify(new ActiveCodeNotification($code , $user->phone_number)) ;
            $request->session()->push('auth_using_sms' , true) ;

        }
        
        return redirect(route('auth.factor.form')) ;


     
    }



}
