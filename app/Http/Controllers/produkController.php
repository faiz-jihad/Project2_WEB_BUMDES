<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function index()
    {
        return view('pages.produk'); // Pastikan file: resources/views/pages/produk.blade.php
    }
}
