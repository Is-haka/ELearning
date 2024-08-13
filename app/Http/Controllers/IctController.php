<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IctController extends Controller
{
    public function ict() {
        return view('categories.ict');
    }
}
