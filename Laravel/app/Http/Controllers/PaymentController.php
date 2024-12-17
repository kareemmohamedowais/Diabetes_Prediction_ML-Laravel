<?php

namespace App\Http\Controllers;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Payment;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }



    public function success()
    {
        return 'تمت عملية الدفع بنجاح!';
    }

    public function cancel()
    {
        return 'تم إلغاء عملية الدفع.';
    }


public function processPayment(Request $request)
{
    // Stripe::setApiKey(env('STRIPE_SECRET'));

    // try {
    //     $charge = Charge::create([
    //         'amount' => 1000,
    //         'currency' => 'usd',
    //         'source' => $request->stripeToken,
    //         'description' => 'Payment for test transaction',
    //     ]);

    //     Payment::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'transaction_id' => $charge->id,
    //         'amount' => $charge->amount,
    //         'status' => 'success',
    //     ]);

    //     return redirect()->route('payment.success');
    // } catch (\Exception $e) {
    //     Payment::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'transaction_id' => null,
    //         'amount' => 1000,
    //         'status' => 'failed',
    //     ]);

    //     return redirect()->route('payment.failed')->with('error', $e->getMessage());
    // }

     // إعداد Stripe بمفتاح السر
     Stripe::setApiKey(env('STRIPE_SECRET'));

     // إنشاء جلسة Checkout
     $checkout_session = Session::create([
         'payment_method_types' => ['card'],
         'line_items' => [[
             'price_data' => [
                 'currency' => 'EGP',
                 'product_data' => [
                     'name' => 'iphone',
                 ],
                 'unit_amount_decimal' => 1250*100, // المبلغ بالسنتات (2000 = 20 دولار)
             ],
             'quantity' => 3,
         ]],
         'mode' => 'payment',
         'success_url' => route('checkout.success'),
         'cancel_url' => route('checkout.cancel'),
     ]);

     // إعادة توجيه المستخدم إلى صفحة الدفع في Stripe
     return redirect($checkout_session->url);
}

}
