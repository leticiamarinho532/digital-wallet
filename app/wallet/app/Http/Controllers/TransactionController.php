<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function doTransaction(Request $request)
    {
        return response()->json(['foo' => 'bar']);
    }
}
