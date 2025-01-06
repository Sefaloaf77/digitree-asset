<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialAppsController extends Controller
{
    public function compose()
    {
        return view('socialapps.compose');
    }
    
    public function inbox()
    {
        return view('socialapps.inbox');
    }
    
    public function chat()
    {
        return view('socialapps.chat');
    }
}
