<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function citas()
    {
        return view('citas');
    }
}
