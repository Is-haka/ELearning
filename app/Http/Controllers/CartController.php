<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page.
     *
     * @return \Illuminate\View\View
     */



    public function index() {
        return view('cart');
    }
}
