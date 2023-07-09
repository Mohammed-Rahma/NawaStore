<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create()
    {
        $countries = Countries::getNames('en');
        return view('shop.checkout', [
            'countries' => $countries
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_first_name' => 'required',
            'customer_last_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'nullable',
            'customer_address' => 'required',
            'customer_city' => 'required',
            'customer_postal_code' => 'nullable',
            'customer_province' => 'nullable',
            'customer_country_code' => 'required|string|size:2',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['payment_status'] = 'pending';
        $validated['currency'] = 'EUR';

        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::with('product')->where('cookie_id', '=', $cookie_id)->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $validated['total'] = $total;

        DB::beginTransaction();

        try {
            $oreder = Order::create($validated);

            foreach ($cart as $item) {
                OrderLine::create([
                    'order_id' => $oreder->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'product_name' => $item->product->name
                ]);
            }

            // Cart::where('cookie_id', '=', $cookie_id)->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ])
                ->with('error', $e->getMessage());
        }



    //send notification to admin !
    $user = User::where('type' , '=' , 'super-admin')->first(); // هاد اليوزر تاع الادمن الي بدي ابعت له الاشعار     

    $user->notify(new NewOrderNotification($oreder));  // تاخد النوتيفيكشن الي انا بدي ابعتها او اليوزر يبعتهاو هان بعتت اوبجكت من كلاس النوتيفيكشن
        return redirect()->route('checkout.success');
    }


    public function success()
    {
        return view('shop.success');
    }
}
