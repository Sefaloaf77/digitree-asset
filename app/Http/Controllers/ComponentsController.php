<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    public function accordions()
    {
        return view('components.accordions');
    }

    public function tabs()
    {
        return view('components.tabs');
    }

    public function modal()
    {
        return view('components.modal');
    }

    public function notification()
    {
        return view('components.notification');
    }

    public function lightbox()
    {
        return view('components.lightbox');
    }

    public function swiper()   
    {
        return view('components.swiper');
    }
}
