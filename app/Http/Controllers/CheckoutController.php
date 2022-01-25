<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Jobs\SendReminderEmail;
use Auth;

class CheckoutController extends Controller
{
    public function store(Request $request){
        $order = new Order();
        $user = Auth::user();

        $request->user = $user;

        $order->create($request);

        dispatch((new SendReminderEmail)->onQueue('highhello'));
        // dispatch((new SendReminderEmail));
        // dispatch((new SendReminderEmail)->onQueue('low'));
        return redirect('home');
    }
}
