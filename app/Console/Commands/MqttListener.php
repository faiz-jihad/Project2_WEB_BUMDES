<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\SensorData;
use App\Events\NewSensorData;

class MqttListener extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Listen MQTT farm/data and store to DB';

    public function handle()
    {
        $server = env('MQTT_HOST', 'broker.hivemq.com');
        $port = intval(env('MQTT_PORT', 1883));
        $clientId = env('MQTT_CLIENT_ID', 'laravel_smartfarm');
        $topic = env('MQTT_TOPIC', 'farm/data');

        $connectionSettings = (new ConnectionSettings)
            ->setUsername(env('MQTT_USERNAME') ?: null)
            ->setPassword(env('MQTT_PASSWORD') ?: null)
            ->setKeepAliveInterval(60);

        $mqtt = new MqttClient($server, $port, $clientId);
        $this->info("Connecting to MQTT {$server}:{$port} ...");
        $mqtt->connect($connectionSettings, true);

        $this->info("Subscribing to topic {$topic} ...");
        $mqtt->subscribe($topic, function (string $topic, string $message) {
            $this->info("Received: {$message}");
            $payload = json_decode($message, true);
            if (!$payload) return;

            // store to DB
            $entry = SensorData::create([
                'temperature' => $payload['temperature'] ?? null,
                'humidity'    => $payload['humidity'] ?? null,
                'soil'        => $payload['soil'] ?? null,
            ]);

            // broadcast via websockets
            event(new NewSensorData($entry->toArray()));

            $this->info("Saved and broadcasted.");
        }, 0);

        $this->info("Listening...");
        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
