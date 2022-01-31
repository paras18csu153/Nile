<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Middleware\CheckGuest;
use App\Models\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(CheckGuest::class);
    }
     
    public function index()
    {
        $user = Auth::user();
        if(!$user->cart){
            $cart = new Cart();
            $cart->create($user);
        }

        return view('home');
    }
}
