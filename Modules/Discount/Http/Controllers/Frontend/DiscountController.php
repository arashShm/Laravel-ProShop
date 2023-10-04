<?php

namespace Modules\Discount\Http\Controllers\Frontend;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Discount\Entities\Discount;
use Modules\Cart\Helpers\Cart ;

class DiscountController extends Controller
{

    public function check(Request $request)
    {

        $data = $request->validate([
            'discount' => 'required|exists:discounts,code',
            'cart' => 'required'
        ]);

        if (!auth()->check()) {
            return back()->withErrors([
                'discount' => 'Please Login To Use Discount'
            ]);
        }

        $discount = Discount::where('code', $request->discount)->first();

        if ($discount->expired_at < now()) {
            return back()->withErrors([
                'discount' => 'Your Code Is Out Of Date'
            ]);
        }


        if ($discount->users()->count()) {
            if (!in_array(auth()->user()->id, $discount->users->pluck('id')->toArray())) {
                return back()->withErrors([
                    'discount' => 'You Are Not Allowed To Use This Code'
                ]);
            }
        }

        $cart = Cart::instance($data['cart']);
        $cart->addDiscount($discount->code);
        return back();
    }


    public function destroy(Request $request)
    {
        $cart = Cart::instance($request->cart) ;
        $cart->addDiscount(null);
    }
}
