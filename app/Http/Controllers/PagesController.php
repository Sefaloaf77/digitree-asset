<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function starterPage()
    {
        return view('pages.starterPage');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }

    public function comingsoon()
    {
        return view('pages.comingsoon');
    }

    public function maintenance()
    {
        return view('pages.maintenance');
    }

    public function error503()
    {
        return view('pages.error503');
    }

    public function error500()
    {
        return view('pages.error500');
    }

    public function error404()
    {
        return view('pages.error404');
    }
}
