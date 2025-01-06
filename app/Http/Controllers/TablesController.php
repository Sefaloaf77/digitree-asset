<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function basicTable()
    {
        return view('tables.basicTable');
    }

    public function dataTable()
    {
        return view('tables.dataTable');
    }

    public function eidtableTable()
    {
        return view('tables.eidtableTable');
    }
}
