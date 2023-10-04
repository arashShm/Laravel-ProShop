<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ActiveCodeNotification ;
use App\Models\ActiveCode;


class TokenAuthController extends Controller
{
    
    public function getPhoneVerify(Request $request)
    {

        if (!$request->session()->has('phone')) {
            return redirect(route('profile.factor.update'));
        }
        $request->session()->reflash();
        return view('profile.phone-verify');
    }


    public function postPhoneVerify(Request $request)
    {

        $request->validate([
            'token' => 'required'
        ]);

        if (!$request->session()->has('phone')) {
            return redirect(route('profile.factor.update'));
        }
        

        $status = ActiveCode::verifyCode($request->token, $request->user());

        if ($status) {
            $request->user()->activeCodes()->delete();
            $request->user()->update([
                'phone_number' => $request->session()->get('phone'),
                'two_factor_type' => 'sms'
            ]);
            alert()->success(  'Verification Complete' ,'Step-2 verification with SMS was complete') ;
        }else{
            alert()->error( 'Verification Failed','Step-2 verification with SMS was failed' ) ;

        }


        return redirect(route('profile.factor.update'));
    }
}
