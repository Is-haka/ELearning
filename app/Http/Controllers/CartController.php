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
    public function index()
    {
        // Ensure the view name matches the file name exactly
        return view('cart');  // or 'Cart' if the file is named 'Cart.blade.php'
    }
}
