<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class JadwalManajemenController extends Controller
{
    public function index()
    {
        return view('admin.managejadwal');
    }
}
