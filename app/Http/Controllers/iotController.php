<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IotController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->view('layouts.403page', [], 403);
        }

        // Ambil data terbaru
        $data = SensorData::latest()->take(20)->get();
        return view('pages.iot', compact('data'));
    }

    public function getLatestData()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $latestData = SensorData::latest()->first();

        if ($latestData) {
            return response()->json([
                'temperature' => $latestData->temperature,
                'humidity' => $latestData->humidity,
                'soil' => $latestData->soil,
                'water' => $latestData->water,
                'created_at' => $latestData->created_at->format('d/m/Y H:i:s')
            ]);
        }

        return response()->json(['error' => 'No data available'], 404);
    }
}
