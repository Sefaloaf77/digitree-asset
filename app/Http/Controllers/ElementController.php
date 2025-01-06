<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function alert()
    {
        return view('elements.alert');
    }

    public function avatar()
    {
        return view('elements.avatar');
    }

    public function badge()
    {
        return view('elements.badge');
    }

    public function buttons()
    {
        return view('elements.buttons');
    }

    public function badges()
    {
        return view('elements.badges');
    }

    public function breadcrumb()
    {
        return view('elements.breadcrumb');
    }

    public function dropdown()
    {
        return view('elements.dropdowns');
    }

    public function loader()
    {
        return view('elements.loader');
    }

    public function pagination()
    {
        return view('elements.pagination');
    }

    public function progressbar()
    {
        return view('elements.progressbar');
    }

}
