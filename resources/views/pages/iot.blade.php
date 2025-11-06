<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SmartFarm IoT - Realtime Control</title>

    <!-- Tailwind + Chart.js + MQTT.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <style>
        .card {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            border-radius: 12px;
        }

        .toast {
            transition: transform .2s ease, opacity .2s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen text-gray-800">

    <header class="bg-green-700 text-white py-4 shadow sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">🌾 SmartFarm IoT</h1>
            <span id="mqttStatus" class="px-3 py-1 rounded-full bg-gray-300 text-gray-700">Connecting...</span>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6 space-y-6">

        <div id="alertBox" class="hidden bg-red-500 text-white p-3 rounded-lg text-center font-semibold shadow">
            ⚠️ Suhu terlalu tinggi!
        </div>

        <!-- Kartu Sensor -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card p-5 bg-white border-t-4 border-red-500">
                <div class="text-sm text-gray-500">Suhu Udara</div>
                <div id="tempCard" class="text-3xl font-bold text-red-600 mt-2">
                    {{ $data->first()->temperature ?? '--' }}°C</div>
            </div>
            <div class="card p-5 bg-white border-t-4 border-blue-500">
                <div class="text-sm text-gray-500">Kelembapan</div>
                <div id="humCard" class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $data->first()->humidity ?? '--' }}%</div>
            </div>
            <div class="card p-5 bg-white border-t-4 border-green-500">
                <div class="text-sm text-gray-500">Kelembapan Tanah</div>
                <div id="soilCard" class="text-3xl font-bold text-green-600 mt-2">{{ $data->first()->soil ?? '--' }}%
                </div>
            </div>
            <div class="card p-5 bg-white border-t-4 border-yellow-500">
                <div class="text-sm text-gray-500">Ketinggian Air</div>
                <div id="waterCard" class="text-3xl font-bold text-yellow-600 mt-2">{{ $data->first()->water ?? '--' }}
                    cm</div>
            </div>
        </div>

        <!-- Panel Kontrol -->
        <div class="card p-6 bg-white">
            <h2 class="font-semibold mb-3"> Kontrol Sistem</h2>
            <div class="flex flex-wrap gap-3 items-center">
                <button id="btnOn" class="px-4 py-2 bg-green-600 text-white rounded">Pompa ON</button>
                <button id="btnOff" class="px-4 py-2 bg-red-600 text-white rounded">Pompa OFF</button>
                <button id="btnAuto" class="px-4 py-2 bg-blue-600 text-white rounded">Mode AUTO</button>
                <button id="btnManual" class="px-4 py-2 bg-yellow-500 text-white rounded">Mode MANUAL</button>
                <div class="ml-4">
                    <div id="pumpStatus" class="text-sm text-green-600 font-semibold">Pompa: --</div>
                    <div id="modeStatus" class="text-sm text-blue-600 font-semibold">Mode: --</div>
                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="card p-6 bg-white">
            <h2 class="font-semibold mb-3">Grafik Suhu & Kelembapan</h2>
            <div class="relative w-full" style="height: 350px;"> <!-- box chart tetap -->
                <canvas id="chartTempHum"></canvas>
            </div>
        </div>

        <!-- Log Sensor -->
        <div class="card p-6 bg-white overflow-x-auto">
            <h2 class="font-semibold mb-3">Log Sensor Terbaru</h2>
            <table id="sensorTable" class="min-w-full text-sm">
                <thead class="bg-green-50 text-green-800">
                    <tr>
                        <th class="py-2 px-4">Waktu</th>
                        <th class="py-2 px-4">Suhu</th>
                        <th class="py-2 px-4">Kelembapan</th>
                        <th class="py-2 px-4">Soil</th>
                        <th class="py-2 px-4">Air</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td class="py-2 px-4">{{ $d->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="py-2 px-4 text-red-600">{{ $d->temperature }}</td>
                            <td class="py-2 px-4 text-blue-600">{{ $d->humidity }}</td>
                            <td class="py-2 px-4 text-green-600">{{ $d->soil }}</td>
                            <td class="py-2 px-4 text-yellow-600">{{ $d->water }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>

    <footer class="text-center text-gray-500 py-6">SmartFarm © {{ date('Y') }}</footer>

    <!-- ===== JS MQTT ===== -->
    <script>
        // ==== MQTT CONFIG ====
        const MQTT_URL = 'wss://broker.hivemq.com:8884/mqtt'; // versi TLS aman

        const clientId = "SmartFarmWeb-" + Math.random().toString(16).substr(2, 8);
        const TOPIC_DATA = "farm/data";
        const TOPIC_STATUS = "farm/status";
        const TOPIC_CONTROL = "farm/control";
        const TOPIC_MODE = "farm/mode";

        const mqttStatus = document.getElementById('mqttStatus');
        const alertBox = document.getElementById('alertBox');

        console.log("🔌 Connecting to MQTT broker:", MQTT_URL, "ClientID:", clientId);

        const client = mqtt.connect(MQTT_URL, {
            clientId,
            clean: true,
            reconnectPeriod: 3000
        });

        // ==== MQTT EVENT ====
        client.on('connect', () => {
            console.log("✅ Connected to broker");
            mqttStatus.textContent = "Connected";
            mqttStatus.className = "px-3 py-1 rounded-full bg-green-500 text-white";
            client.subscribe([TOPIC_DATA, TOPIC_STATUS]);
            toast("Terhubung ke MQTT");
        });

        client.on('reconnect', () => {
            console.log("♻️ Reconnecting...");
            mqttStatus.textContent = "Reconnecting...";
            mqttStatus.className = "px-3 py-1 rounded-full bg-yellow-500 text-white";
        });

        client.on('close', () => {
            console.log("❌ Connection closed");
            mqttStatus.textContent = "Disconnected";
            mqttStatus.className = "px-3 py-1 rounded-full bg-red-500 text-white";
        });

        client.on('error', (err) => {
            console.error("🚨 MQTT Error:", err);
            mqttStatus.textContent = "Error";
            mqttStatus.className = "px-3 py-1 rounded-full bg-red-600 text-white";
        });

        client.on('message', (topic, message) => {
            console.log("📩 Message:", topic, message.toString());
            try {
                const obj = JSON.parse(message.toString());

                if (topic === TOPIC_DATA) {
                    updateCards(obj);
                    updateChart(obj);
                    updateTable(obj);
                }

                if (topic === TOPIC_STATUS) {
                    updateStatus(obj);
                }
            } catch (e) {
                console.error("❗ Invalid JSON:", e);
            }
        });

        // ==== UPDATE UI ====
        function updateCards(obj) {
            document.getElementById('tempCard').textContent = obj.temperature + "°C";
            document.getElementById('humCard').textContent = obj.humidity + "%";
            document.getElementById('soilCard').textContent = obj.soil + "%";
            document.getElementById('waterCard').textContent = obj.water + " cm";
            alertBox.classList.toggle('hidden', obj.temperature <= 35);
        }

        function updateStatus(obj) {
            document.getElementById('pumpStatus').textContent = "Pompa: " + obj.pump;
            document.getElementById('modeStatus').textContent = "Mode: " + obj.mode;
        }

        // ==== CONTROL BUTTON ====
        function publish(topic, msg) {
            if (client.connected) {
                client.publish(topic, msg);
                console.log("📤 Publish:", topic, msg);
                toast("Terkirim: " + msg);
            } else {
                toast("⚠️ Tidak terhubung ke MQTT!");
            }
        }

        document.getElementById('btnOn').onclick = () => publish(TOPIC_CONTROL, 'ON');
        document.getElementById('btnOff').onclick = () => publish(TOPIC_CONTROL, 'OFF');
        document.getElementById('btnAuto').onclick = () => publish(TOPIC_MODE, 'AUTO');
        document.getElementById('btnManual').onclick = () => publish(TOPIC_MODE, 'MANUAL');

        // ==== TOAST ====
        function toast(msg) {
            const el = document.createElement('div');
            el.className = 'toast fixed right-4 bottom-4 bg-green-700 text-white px-4 py-2 rounded shadow-lg';
            el.innerText = msg;
            document.body.appendChild(el);
            setTimeout(() => el.remove(), 2500);
        }

        // ==== CHART ====
        const ctx = document.getElementById('chartTempHum').getContext('2d');

        // Gradient untuk tampilan lembut
        const gradTemp = ctx.createLinearGradient(0, 0, 0, 300);
        gradTemp.addColorStop(0, 'rgba(239,68,68,0.4)');
        gradTemp.addColorStop(1, 'rgba(239,68,68,0.05)');

        const gradHum = ctx.createLinearGradient(0, 0, 0, 300);
        gradHum.addColorStop(0, 'rgba(59,130,246,0.4)');
        gradHum.addColorStop(1, 'rgba(59,130,246,0.05)');

        const chartTempHum = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                        label: 'Suhu (°C)',
                        data: [],
                        borderColor: '#ef4444',
                        backgroundColor: gradTemp,
                        tension: 0.35,
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 2,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#ef4444',
                    },
                    {
                        label: 'Kelembapan (%)',
                        data: [],
                        borderColor: '#3b82f6',
                        backgroundColor: gradHum,
                        tension: 0.35,
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 2,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#3b82f6',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // biar bisa diatur pakai height container
                animation: false, // realtime cepat
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Waktu',
                            color: '#555'
                        },
                        ticks: {
                            color: '#333'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nilai Sensor',
                            color: '#555'
                        },
                        beginAtZero: true,
                        ticks: {
                            color: '#333'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 13
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                }
            }
        });

    // === FUNGSI UPDATE CHART ===
    function updateChart(obj) {
        const now = new Date().toLocaleTimeString();

        chartTempHum.data.labels.push(now);
        chartTempHum.data.datasets[0].data.push(obj.temperature);
        chartTempHum.data.datasets[1].data.push(obj.humidity);

        // Maksimal 20 titik data
        if (chartTempHum.data.labels.length > 20) {
            chartTempHum.data.labels.shift();
            chartTempHum.data.datasets[0].data.shift();
            chartTempHum.data.datasets[1].data.shift();
        }

        chartTempHum.update('none');
    }

        // === FALLBACK AJAX FETCH EVERY 5 SECONDS ===
        function fetchLatestData() {
            fetch('/api/sensors/latest')
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        updateCards(data);
                        updateChart(data);
                        updateTable(data);
                    }
                })
                .catch(error => console.error('Error fetching latest data:', error));
        }

        // Fetch data every 5 seconds as fallback
        setInterval(fetchLatestData, 5000);

        // Initial fetch
        fetchLatestData();
    </script>
</body>

</html>
