<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TransaksiManajemenController extends Controller
{
    public function index()
    {
        return view('admin.managetransaksi');
    }
}
