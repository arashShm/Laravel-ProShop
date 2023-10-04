<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\LoginToSiteNotification;


class AuthTwoFactorController extends Controller
{


    public function getToken(Request $request)
    {
        if (!$request->session('auth')) {
            return redirect(route('login'));
        }


        $request->session()->reflash();
        return view('auth.token');
    }



    public function postToken(Request $request)
    {
        $code = $request->validate([
            'token' => 'required'
        ]);


        if (!$request->session('auth')) {
            return redirect(route('login'));
        }

        $user = User::findOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($code, $user);

        if (!$status) {
            alert()->error('Login Failed', 'Your code inserted incorrect');
            return redirect(route('login'));
        }

        if (auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))) {
            $user->notify(new LoginToSiteNotification());
            $user->activeCodes()->delete();
            return redirect(route('home'));
        }
        return redirect(route('login'));
    }
}
