<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EspecialidadController extends Controller
{
    public function index()
    {
        return view('admin.especialidades.index');
    }
}
