<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        return response()->json(['foo' => 'bar']);
    }

    public function logIn(Request $request)
    {
        return response()->json(['foo' => 'bar']);
    }
}
