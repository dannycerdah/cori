<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BloqueoController extends Controller
{
    public function index()
    {
        return view('admin.bloqueos.index');
    }
}
