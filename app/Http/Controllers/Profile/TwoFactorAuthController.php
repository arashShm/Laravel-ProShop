<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification ;
use Illuminate\Validation\Rule ;

class TwoFactorAuthController extends Controller
{


    public function twoFactor()
    {
        return view('profile.two-factor-auth');
    }

    

    public function manageTwoFactor(Request $request)
    {

        $data = $this->validateRequestData($request);


        if ($this->isRequestTypeSms($data)) {
            //validation phone number

            if ($request->user()->phone_number !== $data['phone']) {
                //create a code and send to user
                return $this->createCodeAndSendSms($request , $data);
            
            } else {
                $request->user()->update([
                    'two_factor_type' => 'sms'
                ]);
            }
        }

        if ($this->isRequestTypeOff($data)) {
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }

        return back();
    }


    private function validateRequestData(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:sms,off',
            'phone' => ['required_unless:type,off' , Rule::unique('users' , 'phone_number')->ignore($request->user()->id)]
        ]);

        return $data ;
    }


    private function isRequestTypeSms($data) : bool
    {
        return $data['type'] === 'sms' ;
    }


    private function createCodeAndSendSms(Request $request , $data)
    {
        $request->session()->flash('phone', $data['phone']);

        //create Code 
        $code = ActiveCode::generateCode($request->user());

        //send sms
        $request->user()->notify(new ActiveCodeNotification($code , $data['phone']));

        return redirect(route('profile.factor.phone'));
    }


    private function isRequestTypeOff($data) : bool
    {
        return $data['type'] === 'off' ;
    }
}
