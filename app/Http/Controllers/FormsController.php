<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function basic()
    {
        return view('forms.basic');
    }

    public function inputGroup()
    {
        return view('forms.inputGroup');
    }

    public function validation()
    {
        return view('forms.validation');
    }

    public function checkbox()
    {
        return view('forms.checkbox');
    }

    public function radio()
    {
        return view('forms.radio');
    }

    public function switches()
    {
        return view('forms.switches');
    }

}
