<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;

class OrderController extends Controller
{



    public function index()
    {
        $orders = auth()->user()->orders()->paginate(10) ;
        return view('profile.orders-list' , compact('orders'));
    }


    public function showDetails(Order $order)
    {
        $this->authorize('view' , $order);
        return view('profile.orders-detail' , compact('order'));
    }


    public function payment(Order $order)
    {
        $this->authorize('view' , $order);

         // Create new invoice.
         $invoice = (new Invoice)->amount(1000);
         // Purchase and pay the given invoice.
         // You should use return statement to redirect user to the bank page.
         return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId, $invoice) use ($order) {
             // Store transactionId in database as we need it to verify payment in the future.
             $order->payments()->create([
                 'resnumber' => $invoice->getUuid(),
             ]);
         })->pay()->render();
    }
}
