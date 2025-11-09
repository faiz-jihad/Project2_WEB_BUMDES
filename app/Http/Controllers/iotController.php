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

    public function getLatestData()
    {
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
