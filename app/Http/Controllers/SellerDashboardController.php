<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckIsSeller;

class SellerDashboardController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
    $this->middleware(CheckIsSeller::class);
  }

  public function index() {
    return view('sellers.dashboard');
  }
}
