<?php

namespace App\Http\Controllers;

class DealsController extends Controller
{
    public function index()
    {
        return view('deals.index');
    }
}
