<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('front/app');
    }
}
