<?php

namespace App\Http\Controllers;

class DealsController extends Controller
{
    public function index()
    {
        return view('deals.index');
    }

    public function pending()
    {
        return view('deals.pending');
    }

    public function won()
    {
        return view('deals.won');
    }

    public function verified()
    {
        return view('deals.verified');
    }
}
