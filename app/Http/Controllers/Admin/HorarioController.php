<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HorarioController extends Controller
{
    public function index()
    {
        return view('admin.horarios.index');
    }
}
