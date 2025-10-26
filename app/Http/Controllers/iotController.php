<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class IotController extends Controller
{
    public function index()
    {
        // Ambil data terbaru
        
        $data = SensorData::latest()->take(20)->get();
        return view('pages.iot', compact('data'));
    }
}
