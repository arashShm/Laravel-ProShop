<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payment;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;




class PaymentController extends Controller
{
    public function payment()
    {
        $cart = Cart::instance('default');
        $cartItem =  $cart->all();

        if ($cartItem->count()) {
            $price = $cartItem->sum(function ($cart) {

                return $cart['discount_percent'] == 0
                    ? $cart['product']->price * $cart['quantity']
                    : ($cart['product']->price - ($cart['product']->price * $cart['discount_percent'])) * $cart['quantity'];
            });

            $orderItem = $cartItem->mapWithKeys(function ($cart) {
                return [$cart['product']->id => ['quantity' => $cart['quantity']]];
            });


            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price
            ]);


            $order->products()->attach($orderItem);


            // Create new invoice.
            $invoice = (new Invoice)->amount(1000);
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId, $invoice) use ($order, $cart) {
                // Store transactionId in database as we need it to verify payment in the future.
                $order->payments()->create([
                    'resnumber' => $invoice->getUuid(),
                ]);
                $cart->flush();
            })->pay()->render();
        }



        return back();
    }




    public function callback(Request $request)
    {

        try {

            $payment = Payment::where('renumber', $request->clientrefid)->firstOrFail();


            $receipt = ShetabitPayment::amount($payment->order->price)->transactionId($request->clientrefid)->verify();

            $payment->update([
                'status' => 1
            ]);

            $payment->order()->update([
                'status' => 'paid'
            ]);

            alert()->success('پرداخت شما موفق بود');
            return redirect('/products');
        } catch (InvalidPaymentException $exception) {

            return $exception->getMessage();

            alert()->error($exception->getMessage());
            return redirect('/products');
        }




        // $payment = Payment::where('resnumber', $request->clientrefid)->firstOrFail();

        // $token = config('services.payping.token');

        // $payping = new \PayPing\Payment($token);

        // try {
        //     // $payment->price
        //     if ($payping->verify($request->refid, 1000)) {
        //         $payment->update([
        //             'status' => 1
        //         ]);

        //         $payment->order()->update([
        //             'status' => 'paid'
        //         ]);

        //         alert()->success('پرداخت شما موفق بود');
        //         return redirect('/products');
        //     } else {
        //         alert()->error('پرداخت شما تایید نشد');
        //         return redirect('/products');
        //     }
        // } catch (\Exception $e) {
        //     $errors = collect(json_decode($e->getMessage(), true));

        //     alert()->error($errors->first());
        //     return redirect('/products');
        // }
    }
}
