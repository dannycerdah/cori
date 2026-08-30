<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ServicioController extends Controller
{
    public function index()
    {
        return view('admin.servicios.index');
    }
}
