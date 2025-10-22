<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    

    // Publish control command to MQTT
    public function controlPump(Request $req)
    {
        $cmd = $req->input('cmd', 'ON'); // ON or OFF
        $server = env('MQTT_HOST');
        $port = env('MQTT_PORT', 1883);
        $clientId = 'laravel_ctrl_'.uniqid();
        $topic = env('MQTT_CONTROL_TOPIC', 'farm/control/pump');

        $mqtt = new MqttClient($server, $port, $clientId);
        $connectionSettings = (new ConnectionSettings)
            ->setUsername(env('MQTT_USERNAME') ?: null)
            ->setPassword(env('MQTT_PASSWORD') ?: null);
        $mqtt->connect($connectionSettings, true);
        $mqtt->publish($topic, $cmd, 0);
        $mqtt->disconnect();

        return response()->json(['status'=>'ok','cmd'=>$cmd]);
    }
    public function recentData($limit = 50)
{
    $data = SensorData::orderBy('created_at', 'desc')
                       ->limit($limit)
                       ->get()
                       ->reverse()
                       ->values();
    return response()->json($data);
}

}
