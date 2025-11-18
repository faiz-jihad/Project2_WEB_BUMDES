@extends('layouts.master')

@section('title', 'SmartFarm IoT - Realtime Control')

@section('content')
    <br><br>
    <section class="iot-section">
        <div class="container">
            <div class="iot-header">
                <h1 class="iot-title">🌾 SmartFarm IoT</h1>
                <div class="status-container">
                    <span id="mqttStatus" class="status-badge">Connecting...</span>
                    <div class="connection-indicator">
                        <div class="indicator-dot" id="connectionDot"></div>
                        <span class="indicator-text">MQTT Connection</span>
                    </div>
                </div>
            </div>

            <div class="iot-content">
                <!-- Alert Box -->
                <div id="alertBox" class="alert-box hidden">
                    ⚠️ Suhu terlalu tinggi!
                </div>

                <!-- Sensor Cards -->
                <div class="sensor-grid">
                    <div class="sensor-card temperature-card">
                        <div class="sensor-icon"><i class="fas fa-thermometer-half"></i></div>
                        <div class="sensor-info">
                            <div class="sensor-label">Suhu Udara</div>
                            <div id="tempCard" class="sensor-value">{{ $data->first()->temperature ?? '--' }}°C</div>
                        </div>
                        <div class="sensor-status" id="tempStatus">Normal</div>
                    </div>

                    <div class="sensor-card humidity-card">
                        <div class="sensor-icon"><i class="fas fa-tint"></i></div>
                        <div class="sensor-info">
                            <div class="sensor-label">Kelembapan Udara</div>
                            <div id="humCard" class="sensor-value">{{ $data->first()->humidity ?? '--' }}%</div>
                        </div>
                        <div class="sensor-status" id="humStatus">Normal</div>
                    </div>

                    <div class="sensor-card soil-card">
                        <div class="sensor-icon"><i class="fas fa-seedling"></i></div>
                        <div class="sensor-info">
                            <div class="sensor-label">Kelembapan Tanah</div>
                            <div id="soilCard" class="sensor-value">{{ $data->first()->soil ?? '--' }}%</div>
                        </div>
                        <div class="sensor-status" id="soilStatus">Normal</div>
                    </div>

                    <div class="sensor-card water-card">
                        <div class="sensor-icon"><i class="fas fa-water"></i></div>
                        <div class="sensor-info">
                            <div class="sensor-label">Ketinggian Air</div>
                            <div id="waterCard" class="sensor-value">{{ $data->first()->water ?? '--' }}cm</div>
                        </div>
                        <div class="sensor-status" id="waterStatus">Normal</div>
                    </div>
                </div>

                <!-- Control Panel -->
                <div class="control-panel">
                    <h2 class="control-title">Kontrol Sistem</h2>
                    <div class="control-buttons">
                        <button id="btnOn" class="control-btn on-btn">
                            <span class="btn-icon"><i class="fas fa-play"></i></span>
                            <span class="btn-text">Pompa ON</span>
                        </button>
                        <button id="btnOff" class="control-btn off-btn">
                            <span class="btn-icon"><i class="fas fa-stop"></i></span>
                            <span class="btn-text">Pompa OFF</span>
                        </button>
                        <button id="btnAuto" class="control-btn auto-btn">
                            <span class="btn-icon"><i class="fas fa-robot"></i></span>
                            <span class="btn-text">Mode AUTO</span>
                        </button>
                        <button id="btnManual" class="control-btn manual-btn">
                            <span class="btn-icon"><i class="fas fa-hand-paper"></i></span>
                            <span class="btn-text">Mode MANUAL</span>
                        </button>
                    </div>
                    <div class="status-display">
                        <div id="pumpStatus" class="status-item">Pompa: --</div>
                        <div id="modeStatus" class="status-item">Mode: --</div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-section">
                    <h2 class="chart-title">Grafik Suhu & Kelembapan</h2>
                    <div class="chart-container">
                        <canvas id="chartTempHum"></canvas>
                    </div>
                </div>

                <!-- Sensor Log -->
                <div class="sensor-log">
                    <h2 class="log-title">Log Sensor Terbaru</h2>
                    <div class="log-navigation">
                        <button id="prevPage" class="nav-btn" disabled><i class="fas fa-chevron-left"></i>
                            Sebelumnya</button>
                        <span id="pageInfo" class="page-info">Halaman 1</span>
                        <button id="nextPage" class="nav-btn"><i class="fas fa-chevron-right"></i> Selanjutnya</button>
                    </div>
                    <div class="log-table-container">
                        <table id="sensorTable" class="sensor-table">
                            <thead class="table-header">
                                <tr>
                                    <th class="table-cell">Waktu</th>
                                    <th class="table-cell">Suhu</th>
                                    <th class="table-cell">Kelembapan</th>
                                    <th class="table-cell">Soil</th>
                                    <th class="table-cell">Air</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($data->take(10) as $d)
                                    <tr class="table-row">
                                        <td class="table-cell">{{ $d->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td class="table-cell temperature-data">{{ $d->temperature }}</td>
                                        <td class="table-cell humidity-data">{{ $d->humidity }}</td>
                                        <td class="table-cell soil-data">{{ $d->soil }}</td>
                                        <td class="table-cell water-data">{{ $d->water }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* IoT Page Styles */
        .iot-section {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .iot-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .iot-title {
            font-size: 2rem;
            font-weight: 700;
            color: #166534;
            margin: 0;
        }

        .status-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .connection-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .indicator-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ef4444;
            animation: pulse 2s infinite;
        }

        .indicator-text {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }

        .iot-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .alert-box {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.2);
            animation: slideIn 0.5s ease-out;
        }

        .sensor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .sensor-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(15px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .sensor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
            border-radius: 20px 20px 0 0;
        }

        .sensor-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .temperature-card {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left: 4px solid #ef4444;
        }

        .humidity-card {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-left: 4px solid #3b82f6;
        }

        .soil-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-left: 4px solid #22c55e;
        }

        .water-card {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border-left: 4px solid #f59e0b;
        }

        .sensor-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            color: #166534;
        }

        .sensor-icon i {
            color: #166534;
        }

        .sensor-info {
            margin-bottom: 0.75rem;
        }

        .sensor-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .sensor-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }

        .sensor-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
        }

        .control-panel {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .control-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
            border-radius: 20px 20px 0 0;
        }

        .control-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .control-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .control-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .control-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
        }

        .control-btn:active {
            transform: translateY(0);
        }

        .on-btn {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .on-btn:hover {
            background: linear-gradient(135deg, #bbf7d0 0%, #a7f3d0 100%);
        }

        .off-btn {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .off-btn:hover {
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        }

        .auto-btn {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        .auto-btn:hover {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
        }

        .manual-btn {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .manual-btn:hover {
            background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
        }

        .btn-icon {
            font-size: 1.25rem;
            color: inherit;
        }

        .status-display {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .status-item {
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            background: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .chart-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
            border-radius: 20px 20px 0 0;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }

        .sensor-log {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .sensor-log::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
            border-radius: 20px 20px 0 0;
        }

        .log-navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        .nav-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.4);
        }

        .nav-btn:disabled {
            background: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            box-shadow: none;
        }

        .page-info {
            font-weight: 600;
            color: #166534;
            padding: 0.5rem 1rem;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .log-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .log-table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .sensor-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .table-header th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-body {
            background: #f9fafb;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: #f3f4f6;
        }

        .table-cell {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }

        .temperature-data {
            color: #ef4444;
            font-weight: 600;
        }

        .humidity-data {
            color: #3b82f6;
            font-weight: 600;
        }

        .soil-data {
            color: #22c55e;
            font-weight: 600;
        }

        .water-data {
            color: #f59e0b;
            font-weight: 600;
        }

        /* Toast Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            color: #374151;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.3s ease-out;
            font-weight: 500;
        }

        .toast-success {
            border-left: 4px solid #22c55e;
        }

        .toast-error {
            border-left: 4px solid #ef4444;
        }

        .toast-info {
            border-left: 4px solid #3b82f6;
        }

        .toast-icon {
            font-size: 1.25rem;
        }

        .toast-message {
            flex: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Status badge colors */
        .status-green {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
        }

        .status-yellow {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .status-red {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .iot-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .iot-title {
                font-size: 1.5rem;
            }

            .sensor-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .control-buttons {
                grid-template-columns: 1fr;
            }

            .status-display {
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
            }

            .chart-container {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .iot-section {
                padding: 1rem 0;
            }

            .container {
                padding: 0 0.5rem;
            }

            .sensor-card {
                padding: 1rem;
            }

            .sensor-value {
                font-size: 1.5rem;
            }

            .control-btn {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        // MQTT Configuration
        const MQTT_URL = 'wss://broker.hivemq.com:8884/mqtt';
        const clientId = "SmartFarmWeb-" + Math.random().toString(16).substr(2, 8);
        const TOPIC_DATA = "farm/data";
        const TOPIC_STATUS = "farm/status";
        const TOPIC_CONTROL = "farm/control";
        const TOPIC_MODE = "farm/mode";

        // DOM Elements
        const mqttStatus = document.getElementById('mqttStatus');
        const connectionDot = document.getElementById('connectionDot');
        const alertBox = document.getElementById('alertBox');

        // Initialize MQTT Client
        const client = mqtt.connect(MQTT_URL, {
            clientId,
            clean: true,
            reconnectPeriod: 3000
        });

        // MQTT Event Handlers
        client.on('connect', () => {
            updateConnectionStatus('Connected', 'green');
            client.subscribe([TOPIC_DATA, TOPIC_STATUS]);
            showToast('Terhubung ke MQTT', 'success');
        });

        client.on('reconnect', () => {
            updateConnectionStatus('Reconnecting...', 'yellow');
        });

        client.on('close', () => {
            updateConnectionStatus('Disconnected', 'red');
        });

        client.on('error', (err) => {
            console.error('MQTT Error:', err);
            updateConnectionStatus('Error', 'red');
        });

        client.on('message', (topic, message) => {
            try {
                const data = JSON.parse(message.toString());
                handleIncomingData(topic, data);
            } catch (e) {
                console.error('Invalid JSON:', e);
            }
        });

        // UI Update Functions
        function updateConnectionStatus(status, color) {
            mqttStatus.textContent = status;
            mqttStatus.className = `status-badge status-${color}`;

            const colors = {
                green: '#22c55e',
                yellow: '#f59e0b',
                red: '#ef4444'
            };

            connectionDot.style.background = colors[color] || colors.red;
        }

        function handleIncomingData(topic, data) {
            if (topic === TOPIC_DATA) {
                updateSensorCards(data);
                updateChart(data);
                updateTable(data);
            } else if (topic === TOPIC_STATUS) {
                updateStatus(data);
            }
        }

        function updateSensorCards(data) {
            // Update card values
            document.getElementById('tempCard').textContent = data.temperature + "°C";
            document.getElementById('humCard').textContent = data.humidity + "%";
            document.getElementById('soilCard').textContent = data.soil + "%";
            document.getElementById('waterCard').textContent = data.water + " cm";

            // Update status indicators
            updateSensorStatus('tempStatus', data.temperature, 35, 'high');
            updateSensorStatus('humStatus', data.humidity, 60, 'optimal');
            updateSensorStatus('soilStatus', data.soil, 40, 'optimal');
            updateSensorStatus('waterStatus', data.water, 10, 'low');

            // Show/hide alert
            alertBox.classList.toggle('hidden', data.temperature <= 35);
        }

        function updateSensorStatus(elementId, value, threshold, type) {
            const element = document.getElementById(elementId);
            let status = 'Normal';
            let color = 'green';

            if (type === 'high' && value > threshold) {
                status = 'Tinggi';
                color = 'red';
            } else if (type === 'low' && value < threshold) {
                status = 'Rendah';
                color = 'orange';
            } else if (type === 'optimal') {
                if (value >= threshold - 10 && value <= threshold + 10) {
                    status = 'Optimal';
                    color = 'green';
                } else {
                    status = 'Normal';
                    color = 'yellow';
                }
            }

            element.textContent = status;
            element.style.background =
                `rgba(${color === 'red' ? '239,68,68' : color === 'orange' ? '245,158,11' : color === 'yellow' ? '245,224,43' : '34,197,94'}, 0.2)`;
            element.style.color = color === 'red' ? '#dc2626' : color === 'orange' ? '#d97706' : color === 'yellow' ?
                '#ca8a04' : '#16a34a';
        }

        function updateStatus(data) {
            document.getElementById('pumpStatus').textContent = "Pompa: " + (data.pump || '--');
            document.getElementById('modeStatus').textContent = "Mode: " + (data.mode || '--');
        }

        // Control Functions
        function publish(topic, message) {
            if (client.connected) {
                client.publish(topic, message);
                showToast(`Terkirim: ${message}`, 'success');
            } else {
                showToast('Tidak terhubung ke MQTT!', 'error');
            }
        }

        // Button Event Listeners
        document.getElementById('btnOn').addEventListener('click', () => publish(TOPIC_CONTROL, 'ON'));
        document.getElementById('btnOff').addEventListener('click', () => publish(TOPIC_CONTROL, 'OFF'));
        document.getElementById('btnAuto').addEventListener('click', () => publish(TOPIC_MODE, 'AUTO'));
        document.getElementById('btnManual').addEventListener('click', () => publish(TOPIC_MODE, 'MANUAL'));

        // Toast Notifications
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `
                <span class="toast-icon">${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}</span>
                <span class="toast-message">${message}</span>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Chart Configuration
        const ctx = document.getElementById('chartTempHum').getContext('2d');

        const gradientTemp = ctx.createLinearGradient(0, 0, 0, 300);
        gradientTemp.addColorStop(0, 'rgba(239, 68, 68, 0.4)');
        gradientTemp.addColorStop(1, 'rgba(239, 68, 68, 0.05)');

        const gradientHum = ctx.createLinearGradient(0, 0, 0, 300);
        gradientHum.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
        gradientHum.addColorStop(1, 'rgba(59, 130, 246, 0.05)');

        const chartTempHum = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Suhu (°C)',
                    data: [],
                    borderColor: '#ef4444',
                    backgroundColor: gradientTemp,
                    tension: 0.4,
                    borderWidth: 3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#ef4444',
                }, {
                    label: 'Kelembapan (%)',
                    data: [],
                    borderColor: '#3b82f6',
                    backgroundColor: gradientHum,
                    tension: 0.4,
                    borderWidth: 3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#3b82f6',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Waktu',
                            color: '#6b7280',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: '#6b7280'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nilai Sensor',
                            color: '#6b7280',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        beginAtZero: true,
                        ticks: {
                            color: '#6b7280'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#374151',
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                }
            }
        });

        // Chart Update Function
        function updateChart(data) {
            const now = new Date().toLocaleTimeString();

            chartTempHum.data.labels.push(now);
            chartTempHum.data.datasets[0].data.push(data.temperature);
            chartTempHum.data.datasets[1].data.push(data.humidity);

            // Keep only last 20 data points
            if (chartTempHum.data.labels.length > 20) {
                chartTempHum.data.labels.shift();
                chartTempHum.data.datasets[0].data.shift();
                chartTempHum.data.datasets[1].data.shift();
            }

            chartTempHum.update('active');
        }

        // Table Update Function
        function updateTable(data) {
            const tbody = document.querySelector('.table-body');
            const newRow = document.createElement('tr');
            newRow.className = 'table-row';
            newRow.innerHTML = `
                <td class="table-cell">${new Date().toLocaleString()}</td>
                <td class="table-cell temperature-data">${data.temperature}</td>
                <td class="table-cell humidity-data">${data.humidity}</td>
                <td class="table-cell soil-data">${data.soil}</td>
                <td class="table-cell water-data">${data.water}</td>
            `;

            // Add new row to top and remove oldest if more than 10 rows
            tbody.insertBefore(newRow, tbody.firstChild);
            if (tbody.children.length > 10) {
                tbody.removeChild(tbody.lastChild);
            }

            // Update pagination
            updatePagination();
        }

        // Pagination variables
        let currentPage = 1;
        const itemsPerPage = 10;
        let allData = @json($data->toArray());

        // Update pagination controls
        function updatePagination() {
            const totalPages = Math.ceil(allData.length / itemsPerPage);
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');
            const pageInfo = document.getElementById('pageInfo');

            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
            pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
        }

        // Show page function
        function showPage(page) {
            const tbody = document.querySelector('.table-body');
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = allData.slice(start, end);

            tbody.innerHTML = '';
            pageData.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'table-row';
                row.innerHTML = `
                    <td class="table-cell">${new Date(item.created_at).toLocaleString('id-ID')}</td>
                    <td class="table-cell temperature-data">${item.temperature}</td>
                    <td class="table-cell humidity-data">${item.humidity}</td>
                    <td class="table-cell soil-data">${item.soil}</td>
                    <td class="table-cell water-data">${item.water}</td>
                `;
                tbody.appendChild(row);
            });
        }

        // Pagination event listeners
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePagination();
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            const totalPages = Math.ceil(allData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
                updatePagination();
            }
        });

        // Initialize pagination
        updatePagination();

        // Fallback AJAX polling
        function fetchLatestData() {
            fetch('/api/sensors/latest')
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        updateSensorCards(data);
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

        // Add loading animation to buttons
        document.querySelectorAll('.control-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
    </script>
@endpush
