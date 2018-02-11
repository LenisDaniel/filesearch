<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoringsController extends Controller
{
    public function index()
    {
        return view('storing');
    }
}
