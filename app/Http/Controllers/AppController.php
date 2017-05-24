<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function token()
    {
        return response()->json([
            'token' => csrf_token(),
        ]);
    }
}
