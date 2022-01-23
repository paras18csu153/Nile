<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Middleware\CheckIsBuyer;

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
        $this->middleware(CheckIsBuyer::class)->except('get', 'getAll');
    }
     
    public function index()
    {
        return view('home');
    }
}
