<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function analysis()
    {
        return view('home.analysis');
    }

    public function ecommerce()
    {
        return view('home.ecommerce');
    }

    public function accounts()
    {
        return view('home.accounts');
    }

    public function changelog()
    {
        return view('home.changelog');
    }

    public function chart()
    {
        return view('home.chart');
    }

    public function contacts()
    {
        return view('home.contacts');
    }

    public function dragdrop()
    {
        return view('home.dragdrop');
    }

    public function fonticons()
    {
        return view('home.fonticons');
    }

    public function orderlist()
    {
        return view('home.orderlist');
    }

    public function payments()
    {
        return view('home.payments');
    }

    public function profilesetting()
    {
        return view('home.profilesetting');
    }

    
}
