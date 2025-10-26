<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\SensorData;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe MQTT farm/data and save to DB';

    public function handle()
    {
        $server = 'broker.hivemq.com';
        $port = 1883;
        $clientId = 'LaravelSub-' . uniqid();

        $settings = (new ConnectionSettings())->setKeepAliveInterval(60);
        $mqtt = new MqttClient($server, $port, $clientId);
        $mqtt->connect($settings, true);

        $mqtt->subscribe('farm/data', function ($topic, $message) {
            $data = json_decode($message, true);
            if ($data) {
                SensorData::create([
                    'temperature' => $data['temperature'] ?? null,
                    'humidity' => $data['humidity'] ?? null,
                    'soil' => $data['soil'] ?? null,
                    'water' => $data['water'] ?? null,
                ]);
                $this->info('Saved sensor data');
            }
        }, 0);

        $mqtt->loop(true);
    }
}
