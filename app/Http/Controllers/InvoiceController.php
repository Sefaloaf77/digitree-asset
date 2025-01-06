<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice()
    {
        return view('invoice.invoice');
    }

    public function invoiceAdd()
    {
        return view('invoice.invoiceAdd');
    }

    public function invoiceList()
    {
        return view('invoice.invoiceList');
    }
}
