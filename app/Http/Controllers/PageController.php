<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function rule()
    {
        return view('page.rule')
            ->withTitle('Terms & Conditions');
    }
}
