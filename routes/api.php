<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SensorData;

Route::post('/sensors', function (Request $request) {
    $data = $request->validate([
        'temperature' => 'required|numeric',
        'humidity' => 'required|numeric',
        'soil' => 'required|numeric',
        'pump_state' => 'required|boolean',
    ]);

    $sensor = SensorData::create($data);
    return response()->json(['status' => 'success', 'data' => $sensor]);
});

Route::get('/sensors/latest', function () {
    return \App\Models\SensorData::latest()->first();
});
// API: recent N data points
Route::get('/sensors/recent/{limit?}', [\App\Http\Controllers\DashboardController::class, 'recentData']);
