<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
      echo "Hello Test"; exit;
    }
    public function agreement()
    {
        return view('agreement');
    }
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }


}
