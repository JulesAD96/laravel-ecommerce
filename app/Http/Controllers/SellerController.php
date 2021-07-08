<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("role:SELLER_ROLE");
    }

    //Index method for Seller Controller
    public function index()
    {
        return view('sellers.home');
    }
}
