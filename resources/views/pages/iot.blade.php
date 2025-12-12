@extends('layouts.master')

@section('title', 'SmartFarm IoT - Realtime Control')

@section('content')
<br><br><br>
    <section class="iot-section">
        <div class="container">
            <!-- Header with animated background -->
            <div class="iot-hero">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="title-icon">🌾</span>
                        SmartFarm IoT Dashboard
                    </h1>
                    <p class="hero-subtitle">Monitoring & Kontrol Real-time Pertanian Cerdas</p>
                </div>

                <div class="connection-status">
                    <div class="status-card">
                        <div class="status-header">
                            <div class="status-indicator">
                                <div class="pulse-ring"></div>
                                <div id="connectionDot" class="status-dot"></div>
                            </div>
                            <span class="status-title">Status Koneksi</span>
                        </div>
                        <div id="mqttStatus" class="status-value">Connecting...</div>
                    </div>
                </div>
            </div>

            <!-- Alert Notification -->
            <div id="alertBox" class="alert-box hidden">
                <div class="alert-content">
                    <div class="alert-icon">⚠️</div>
                    <div class="alert-text">
                        <strong>Peringatan!</strong> Suhu melebihi batas normal. Periksa sistem pendingin.
                    </div>
                </div>
                <button class="alert-close">&times;</button>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Sensor Cards Section -->
                <div class="sensor-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-sensor"></i>
                            Data Sensor Real-time
                        </h2>
                        <div class="last-update" id="lastUpdate">
                            Terakhir update: --
                        </div>
                    </div>

                    <div class="sensor-cards-grid">
                        <!-- Temperature Card -->
                        <div class="sensor-card-glass">
                            <div class="card-gradient temp-gradient"></div>
                            <div class="card-content">
                                <div class="card-header">
                                    <div class="card-icon temp-icon">
                                        <i class="fas fa-thermometer-half"></i>
                                    </div>
                                    <div class="card-label">Suhu Udara</div>
                                </div>
                                <div class="card-body">
                                    <div id="tempCard" class="card-value">{{ $data->first()->temperature ?? '--' }}°C</div>
                                    <div class="card-trend">
                                        <span id="tempTrend" class="trend-indicator">↗</span>
                                        <span id="tempStatus" class="status-badge">Normal</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="range-indicator">
                                        <span>20°C</span>
                                        <div class="range-bar">
                                            <div id="tempRange" class="range-fill"></div>
                                        </div>
                                        <span>40°C</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Humidity Card -->
                        <div class="sensor-card-glass">
                            <div class="card-gradient hum-gradient"></div>
                            <div class="card-content">
                                <div class="card-header">
                                    <div class="card-icon hum-icon">
                                        <i class="fas fa-tint"></i>
                                    </div>
                                    <div class="card-label">Kelembapan Udara</div>
                                </div>
                                <div class="card-body">
                                    <div id="humCard" class="card-value">{{ $data->first()->humidity ?? '--' }}%</div>
                                    <div class="card-trend">
                                        <span id="humTrend" class="trend-indicator">↗</span>
                                        <span id="humStatus" class="status-badge">Normal</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="range-indicator">
                                        <span>30%</span>
                                        <div class="range-bar">
                                            <div id="humRange" class="range-fill"></div>
                                        </div>
                                        <span>80%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Soil Moisture Card -->
                        <div class="sensor-card-glass">
                            <div class="card-gradient soil-gradient"></div>
                            <div class="card-content">
                                <div class="card-header">
                                    <div class="card-icon soil-icon">
                                        <i class="fas fa-seedling"></i>
                                    </div>
                                    <div class="card-label">Kelembapan Tanah</div>
                                </div>
                                <div class="card-body">
                                    <div id="soilCard" class="card-value">{{ $data->first()->soil ?? '--' }}%</div>
                                    <div class="card-trend">
                                        <span id="soilTrend" class="trend-indicator">↗</span>
                                        <span id="soilStatus" class="status-badge">Normal</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="range-indicator">
                                        <span>20%</span>
                                        <div class="range-bar">
                                            <div id="soilRange" class="range-fill"></div>
                                        </div>
                                        <span>80%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Water Level Card -->
                        <div class="sensor-card-glass">
                            <div class="card-gradient water-gradient"></div>
                            <div class="card-content">
                                <div class="card-header">
                                    <div class="card-icon water-icon">
                                        <i class="fas fa-water"></i>
                                    </div>
                                    <div class="card-label">Ketinggian Air</div>
                                </div>
                                <div class="card-body">
                                    <div id="waterCard" class="card-value">{{ $data->first()->water ?? '--' }}cm</div>
                                    <div class="card-trend">
                                        <span id="waterTrend" class="trend-indicator">↗</span>
                                        <span id="waterStatus" class="status-badge">Normal</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="range-indicator">
                                        <span>0cm</span>
                                        <div class="range-bar">
                                            <div id="waterRange" class="range-fill"></div>
                                        </div>
                                        <span>50cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Control Panel & Chart Side by Side -->
                <div class="control-chart-section">
                    <!-- Control Panel -->
                    <div class="control-panel-glass">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                <i class="fas fa-sliders-h"></i>
                                Kontrol Sistem
                            </h2>
                            <div class="mode-display">
                                <div class="mode-label">Mode Saat Ini:</div>
                                <div id="modeStatus" class="mode-value">--</div>
                            </div>
                        </div>

                        <div class="control-buttons-grid">
                            <!-- Pump Control -->
                            <div class="control-group">
                                <h3 class="control-group-title">Kontrol Pompa</h3>
                                <div class="button-group">
                                    <button id="btnOn" class="control-btn-3d on-btn">
                                        <span class="btn-3d-content">
                                            <span class="btn-icon"><i class="fas fa-play"></i></span>
                                            <span class="btn-text">Pompa ON</span>
                                        </span>
                                    </button>
                                    <button id="btnOff" class="control-btn-3d off-btn">
                                        <span class="btn-3d-content">
                                            <span class="btn-icon"><i class="fas fa-stop"></i></span>
                                            <span class="btn-text">Pompa OFF</span>
                                        </span>
                                    </button>
                                </div>
                                <div id="pumpStatus" class="pump-status">Pompa: --</div>
                            </div>

                            <!-- Mode Control -->
                            <div class="control-group">
                                <h3 class="control-group-title">Mode Operasi</h3>
                                <div class="button-group">
                                    <button id="btnAuto" class="control-btn-3d auto-btn">
                                        <span class="btn-3d-content">
                                            <span class="btn-icon"><i class="fas fa-robot"></i></span>
                                            <span class="btn-text">Mode AUTO</span>
                                        </span>
                                    </button>
                                    <button id="btnManual" class="control-btn-3d manual-btn">
                                        <span class="btn-3d-content">
                                            <span class="btn-icon"><i class="fas fa-hand-paper"></i></span>
                                            <span class="btn-text">Mode MANUAL</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="system-stats">
                            <div class="stat-item">
                                <div class="stat-label">Uptime</div>
                                <div class="stat-value">24/7</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Response Time</div>
                                <div class="stat-value">< 500ms</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Accuracy</div>
                                <div class="stat-value">99.8%</div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="chart-section-glass">
                        <div class="chart-header">
                            <h2 class="chart-title">
                                <i class="fas fa-chart-line"></i>
                                Grafik Real-time
                            </h2>
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <span class="legend-color temp-color"></span>
                                    <span>Suhu (°C)</span>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-color hum-color"></span>
                                    <span>Kelembapan (%)</span>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="chartTempHum"></canvas>
                        </div>
                        <div class="chart-controls">
                            <button class="chart-btn" onclick="changeChartRange('1h')">1 Jam</button>
                            <button class="chart-btn active" onclick="changeChartRange('6h')">6 Jam</button>
                            <button class="chart-btn" onclick="changeChartRange('24h')">24 Jam</button>
                            <button class="chart-btn" onclick="exportChart()">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sensor Log -->
                <div class="log-section-glass">
                    <div class="log-header">
                        <h2 class="log-title">
                            <i class="fas fa-history"></i>
                            Log Sensor Terbaru
                        </h2>
                        <div class="log-stats">
                            <span class="stat-badge">
                                <i class="fas fa-database"></i>
                                Total Data: {{ $data->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="log-navigation">
                        <button id="prevPage" class="nav-btn-glass" disabled>
                            <i class="fas fa-chevron-left"></i>
                            <span>Sebelumnya</span>
                        </button>
                        <div class="page-info-glass">
                            <span id="pageInfo">Halaman 1</span>
                            <span class="total-pages">dari 10</span>
                        </div>
                        <button id="nextPage" class="nav-btn-glass">
                            <span>Selanjutnya</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="log-table-container">
                        <table id="sensorTable" class="sensor-table-glass">
                            <thead class="table-header-glass">
                                <tr>
                                    <th class="table-cell">
                                        <i class="fas fa-clock"></i> Waktu
                                    </th>
                                    <th class="table-cell">
                                        <i class="fas fa-thermometer-half"></i> Suhu
                                    </th>
                                    <th class="table-cell">
                                        <i class="fas fa-tint"></i> Kelembapan
                                    </th>
                                    <th class="table-cell">
                                        <i class="fas fa-seedling"></i> Tanah
                                    </th>
                                    <th class="table-cell">
                                        <i class="fas fa-water"></i> Air
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-body-glass">
                                @foreach ($data->take(10) as $d)
                                    <tr class="table-row-glass">
                                        <td class="table-cell timestamp-cell">
                                            <div class="time-main">{{ $d->created_at->format('H:i:s') }}</div>
                                            <div class="time-sub">{{ $d->created_at->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="table-cell temperature-cell">
                                            <span class="value">{{ $d->temperature }}</span>
                                            <span class="unit">°C</span>
                                        </td>
                                        <td class="table-cell humidity-cell">
                                            <span class="value">{{ $d->humidity }}</span>
                                            <span class="unit">%</span>
                                        </td>
                                        <td class="table-cell soil-cell">
                                            <span class="value">{{ $d->soil }}</span>
                                            <span class="unit">%</span>
                                        </td>
                                        <td class="table-cell water-cell">
                                            <span class="value">{{ $d->water }}</span>
                                            <span class="unit">cm</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="log-footer">
                        <div class="refresh-status">
                            <i class="fas fa-sync-alt"></i>
                            Auto-refresh setiap 5 detik
                        </div>
                        <button onclick="refreshData()" class="refresh-btn">
                            <i class="fas fa-redo"></i> Refresh Manual
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Action Button for Quick Actions -->
    <div class="fab-container">
        <button class="fab-main">
            <i class="fas fa-bolt"></i>
        </button>
        <div class="fab-menu">
            <button class="fab-item" onclick="forceRefresh()" title="Refresh Paksa">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="fab-item" onclick="toggleDarkMode()" title="Mode Gelap">
                <i class="fas fa-moon"></i>
            </button>
            <button class="fab-item" onclick="showSettings()" title="Pengaturan">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>

    <!-- Animated Background Elements -->
    <div class="bg-elements">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
        <div class="bg-grid"></div>
    </div>
@endsection

@push('styles')
    <style>
        /* Modern Glassmorphism Design */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Base Styles */
        .iot-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            position: relative;
            overflow: hidden;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Animated Background Elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            animation: float 20s infinite linear;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 10%;
            animation-delay: -5s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            left: 15%;
            animation-delay: -10s;
        }

        .bg-grid {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(102, 126, 234, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(102, 126, 234, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Hero Section */
        .iot-hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 2rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            animation: slideDown 0.6s ease-out;
        }

        .hero-content {
            flex: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .title-icon {
            font-size: 3rem;
        }

        .hero-subtitle {
            color: #666;
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Status Card */
        .status-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1.5rem;
            min-width: 200px;
            box-shadow: var(--glass-shadow);
        }

        .status-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .status-indicator {
            position: relative;
            width: 40px;
            height: 40px;
        }

        .pulse-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.2);
            animation: pulse 2s infinite;
        }

        .status-dot {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ef4444;
            z-index: 2;
        }

        .status-title {
            font-weight: 600;
            color: #666;
        }

        .status-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
            text-align: center;
        }

        /* Alert Box */
        .alert-box {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 6px solid #e17055;
            box-shadow: 0 8px 32px rgba(225, 112, 85, 0.2);
            animation: slideIn 0.5s ease-out;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-icon {
            font-size: 1.5rem;
        }

        .alert-text {
            font-weight: 600;
            color: #d63031;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #d63031;
            transition: var(--transition-smooth);
        }

        .alert-close:hover {
            transform: scale(1.2);
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Sensor Cards - Glassmorphism */
        .sensor-section {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--glass-shadow);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .last-update {
            font-size: 0.875rem;
            color: #666;
            background: rgba(255, 255, 255, 0.5);
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .sensor-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .sensor-card-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition-smooth);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .sensor-card-glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
        }

        .card-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .temp-gradient { background: linear-gradient(90deg, #ff6b6b, #ffa8a8); }
        .hum-gradient { background: linear-gradient(90deg, #4d96ff, #6bc5ff); }
        .soil-gradient { background: linear-gradient(90deg, #51cf66, #94d82d); }
        .water-gradient { background: linear-gradient(90deg, #339af0, #74c0fc); }

        .card-content {
            position: relative;
            z-index: 1;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .temp-icon { background: rgba(255, 107, 107, 0.1); color: #ff6b6b; }
        .hum-icon { background: rgba(77, 150, 255, 0.1); color: #4d96ff; }
        .soil-icon { background: rgba(81, 207, 102, 0.1); color: #51cf66; }
        .water-icon { background: rgba(51, 154, 240, 0.1); color: #339af0; }

        .card-label {
            font-size: 0.875rem;
            color: #666;
            font-weight: 600;
        }

        .card-body {
            margin-bottom: 1rem;
        }

        .card-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .card-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .trend-indicator {
            font-size: 1.25rem;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .card-footer {
            margin-top: 1rem;
        }

        .range-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: #666;
        }

        .range-bar {
            flex: 1;
            height: 6px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }

        .range-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        /* Control Panel & Chart Side by Side */
        .control-chart-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        .control-panel-glass,
        .chart-section-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--glass-shadow);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .panel-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .mode-display {
            text-align: right;
        }

        .mode-label {
            font-size: 0.875rem;
            color: #666;
        }

        .mode-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
        }

        .control-buttons-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .control-group {
            margin-bottom: 1.5rem;
        }

        .control-group-title {
            font-size: 1rem;
            font-weight: 600;
            color: #666;
            margin-bottom: 1rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        /* 3D Button Effect */
        .control-btn-3d {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-3d-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .control-btn-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
            transition: var(--transition-smooth);
        }

        .control-btn-3d:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .control-btn-3d:active {
            transform: translateY(0);
        }

        .on-btn {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
            color: white;
        }

        .off-btn {
            background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
            color: white;
        }

        .auto-btn {
            background: linear-gradient(135deg, #4d96ff 0%, #339af0 100%);
            color: white;
        }

        .manual-btn {
            background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
            color: #333;
        }

        .pump-status {
            text-align: center;
            font-weight: 600;
            color: #333;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            margin-top: 1rem;
        }

        .system-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .stat-item {
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
        }

        /* Chart Section */
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chart-legend {
            display: flex;
            gap: 1.5rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #666;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .temp-color { background: #ff6b6b; }
        .hum-color { background: #4d96ff; }

        .chart-container {
            height: 300px;
            margin-bottom: 1.5rem;
        }

        .chart-controls {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .chart-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.5);
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .chart-btn:hover,
        .chart-btn.active {
            background: var(--primary-gradient);
            color: white;
        }

        /* Log Section */
        .log-section-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--glass-shadow);
        }

        .log-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .log-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .log-stats {
            display: flex;
            gap: 1rem;
        }

        .stat-badge {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .log-navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .nav-btn-glass {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.5);
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-btn-glass:hover:not(:disabled) {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
        }

        .nav-btn-glass:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-info-glass {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .page-info-glass span:first-child {
            font-weight: 700;
            color: #333;
        }

        .total-pages {
            font-size: 0.75rem;
            color: #666;
        }

        .log-table-container {
            overflow-x: auto;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.5);
        }

        .sensor-table-glass {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header-glass {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .table-header-glass th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #666;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        }

        .table-body-glass {
            background: rgba(255, 255, 255, 0.3);
        }

        .table-row-glass {
            transition: var(--transition-smooth);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-row-glass:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .table-cell {
            padding: 1rem;
        }

        .timestamp-cell {
            min-width: 140px;
        }

        .time-main {
            font-weight: 600;
            color: #333;
        }

        .time-sub {
            font-size: 0.75rem;
            color: #666;
        }

        .temperature-cell { color: #ff6b6b; }
        .humidity-cell { color: #4d96ff; }
        .soil-cell { color: #51cf66; }
        .water-cell { color: #339af0; }

        .value {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .unit {
            font-size: 0.75rem;
            opacity: 0.7;
        }

        .log-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .refresh-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.875rem;
        }

        .refresh-btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* Floating Action Button */
        .fab-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .fab-main {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        .fab-main:hover {
            transform: scale(1.1) rotate(90deg);
        }

        .fab-menu {
            position: absolute;
            bottom: 70px;
            right: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition-smooth);
            pointer-events: none;
        }

        .fab-container:hover .fab-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .fab-item {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: none;
            color: #666;
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .fab-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: scale(1.1);
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
            }
            50% {
                transform: scale(1);
                opacity: 0.4;
            }
            100% {
                transform: scale(0.8);
                opacity: 0.8;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0);
            }
            25% {
                transform: translate(20px, 20px);
            }
            50% {
                transform: translate(-10px, 40px);
            }
            75% {
                transform: translate(30px, -10px);
            }
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        }

        .toast-success {
            border-left: 4px solid #51cf66;
        }

        .toast-error {
            border-left: 4px solid #ff6b6b;
        }

        .toast-info {
            border-left: 4px solid #4d96ff;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .control-chart-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .iot-hero {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }

            .hero-title {
                font-size: 2rem;
                justify-content: center;
            }

            .sensor-cards-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .system-stats {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .log-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .chart-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .chart-legend {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.5rem;
            }

            .card-value {
                font-size: 2rem;
            }

            .control-btn-3d {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            .fab-container {
                bottom: 1rem;
                right: 1rem;
            }
        }

        /* Utility Classes */
        .hidden {
            display: none !important;
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            :root {
                --glass-bg: rgba(30, 30, 30, 0.3);
                --glass-border: rgba(255, 255, 255, 0.1);
            }

            .iot-section {
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            }

            .hero-subtitle,
            .status-title,
            .card-label,
            .section-title,
            .panel-title,
            .chart-title,
            .log-title,
            .stat-label,
            .mode-label,
            .control-group-title,
            .last-update,
            .range-indicator span,
            .time-sub,
            .refresh-status {
                color: #aaa;
            }

            .status-value,
            .mode-value,
            .stat-value,
            .card-value,
            .pump-status,
            .time-main,
            .value {
                color: #fff;
            }

            .sensor-card-glass,
            .control-panel-glass,
            .chart-section-glass,
            .log-section-glass {
                background: rgba(30, 30, 30, 0.5);
            }

            .log-table-container {
                background: rgba(30, 30, 30, 0.3);
            }

            .table-body-glass {
                background: rgba(30, 30, 30, 0.2);
            }

            .table-row-glass:hover {
                background: rgba(255, 255, 255, 0.1);
            }

            .bg-grid {
                background-image:
                    linear-gradient(rgba(102, 126, 234, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(102, 126, 234, 0.1) 1px, transparent 1px);
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        // Enhanced MQTT Configuration with more options
        const MQTT_CONFIG = {
            url: 'wss://broker.hivemq.com:8884/mqtt',
            clientId: "SmartFarmWeb_" + Math.random().toString(36).substr(2, 9),
            clean: true,
            reconnectPeriod: 2000,
            keepalive: 30,
            connectTimeout: 5000
        };

        const TOPICS = {
            DATA: "farm/data",
            STATUS: "farm/status",
            CONTROL: "farm/control",
            MODE: "farm/mode",
            ALERTS: "farm/alerts"
        };

        // Initialize enhanced MQTT client
        const client = mqtt.connect(MQTT_CONFIG.url, {
            clientId: MQTT_CONFIG.clientId,
            clean: MQTT_CONFIG.clean,
            reconnectPeriod: MQTT_CONFIG.reconnectPeriod,
            keepalive: MQTT_CONFIG.keepalive,
            connectTimeout: MQTT_CONFIG.connectTimeout
        });

        // State management
        const appState = {
            lastUpdate: null,
            sensorHistory: {
                temperature: [],
                humidity: [],
                soil: [],
                water: []
            },
            currentMode: null,
            pumpStatus: null,
            chartRange: '6h',
            connectionQuality: 100
        };

        // Enhanced connection status management
        const connectionStatus = {
            update(status, quality) {
                const dot = document.getElementById('connectionDot');
                const text = document.getElementById('mqttStatus');
                const rings = document.querySelectorAll('.pulse-ring');

                const statusConfig = {
                    connected: {
                        color: '#51cf66',
                        text: 'Terhubung',
                        pulse: true,
                        quality: quality
                    },
                    connecting: {
                        color: '#ffd43b',
                        text: 'Menghubungkan...',
                        pulse: true,
                        quality: 50
                    },
                    reconnecting: {
                        color: '#ffa94d',
                        text: 'Menyambung ulang...',
                        pulse: true,
                        quality: 30
                    },
                    disconnected: {
                        color: '#ff6b6b',
                        text: 'Terputus',
                        pulse: false,
                        quality: 0
                    },
                    error: {
                        color: '#ff6b6b',
                        text: 'Error',
                        pulse: false,
                        quality: 0
                    }
                };

                const config = statusConfig[status] || statusConfig.error;

                dot.style.background = config.color;
                text.textContent = `${config.text} (${config.quality}%)`;
                text.style.color = config.color;

                rings.forEach(ring => {
                    ring.style.background = `radial-gradient(circle, ${config.color}20 0%, transparent 70%)`;
                    ring.style.animation = config.pulse ? 'pulse 2s infinite' : 'none';
                });

                appState.connectionQuality = config.quality;
            },

            measureLatency() {
                const start = Date.now();
                client.publish('farm/ping', 'ping', { qos: 0 }, () => {
                    const latency = Date.now() - start;
                    const quality = Math.max(0, 100 - latency / 10);
                    this.update('connected', Math.min(100, quality));
                });
            }
        };

        // MQTT Event Handlers
        client.on('connect', () => {
            connectionStatus.update('connected', 100);
            showToast('✅ Berhasil terhubung ke server MQTT', 'success');

            // Subscribe to all topics
            Object.values(TOPICS).forEach(topic => {
                client.subscribe(topic, { qos: 1 }, (err) => {
                    if (!err) console.log(`Subscribed to ${topic}`);
                });
            });

            // Start latency measurement
            setInterval(() => connectionStatus.measureLatency(), 30000);
        });

        client.on('reconnect', () => {
            connectionStatus.update('reconnecting', 30);
        });

        client.on('close', () => {
            connectionStatus.update('disconnected', 0);
            showToast('❌ Koneksi terputus, mencoba menyambung ulang...', 'error');
        });

        client.on('error', (err) => {
            console.error('MQTT Error:', err);
            connectionStatus.update('error', 0);
            showToast('⚠️ Error koneksi MQTT', 'error');
        });

        client.on('message', (topic, message) => {
            try {
                const data = JSON.parse(message.toString());
                processIncomingData(topic, data);

                // Update last update time
                appState.lastUpdate = new Date();
                updateLastUpdateTime();
            } catch (e) {
                console.error('Invalid JSON:', e);
            }
        });

        // Process incoming data with animations
        function processIncomingData(topic, data) {
            switch (topic) {
                case TOPICS.DATA:
                    updateSensorCardsWithAnimation(data);
                    updateChartData(data);
                    updateLogTable(data);
                    checkAlerts(data);
                    break;

                case TOPICS.STATUS:
                    updateSystemStatus(data);
                    break;

                case TOPICS.ALERTS:
                    showAlert(data.message, data.type);
                    break;
            }
        }

        // Enhanced sensor card updates with animations
        function updateSensorCardsWithAnimation(data) {
            const sensors = [
                { id: 'tempCard', value: data.temperature, unit: '°C', type: 'temperature' },
                { id: 'humCard', value: data.humidity, unit: '%', type: 'humidity' },
                { id: 'soilCard', value: data.soil, unit: '%', type: 'soil' },
                { id: 'waterCard', value: data.water, unit: 'cm', type: 'water' }
            ];

            sensors.forEach(sensor => {
                const element = document.getElementById(sensor.id);
                const oldValue = parseFloat(element.textContent.replace(/[^0-9.-]+/g, ''));
                const newValue = sensor.value;

                // Animate value change
                animateValueChange(element, oldValue, newValue, sensor.unit);

                // Update range indicators
                updateRangeIndicator(sensor.type, newValue);

                // Update trend indicator
                updateTrendIndicator(sensor.type, newValue);

                // Update status with color coding
                updateSensorStatus(sensor.type, newValue);
            });
        }

        // Animate value changes
        function animateValueChange(element, oldValue, newValue, unit) {
            const duration = 500;
            const startTime = Date.now();

            function update() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = easeOutCubic(progress);
                const currentValue = oldValue + (newValue - oldValue) * eased;

                element.textContent = currentValue.toFixed(1) + unit;

                // Add pulse effect
                element.style.transform = `scale(${1 + 0.1 * eased})`;
                element.style.color = `hsl(${120 + (newValue - oldValue) * 10}, 70%, 50%)`;

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.style.transform = 'scale(1)';
                    element.style.color = '';
                }
            }

            update();
        }

        // Update range indicators with animation
        function updateRangeIndicator(type, value) {
            const element = document.getElementById(type + 'Range');
            if (!element) return;

            let percentage;
            switch (type) {
                case 'temperature':
                    percentage = ((value - 20) / 20) * 100;
                    element.style.background = `linear-gradient(90deg, #ff6b6b, ${value > 35 ? '#ffa8a8' : '#51cf66'})`;
                    break;
                case 'humidity':
                    percentage = ((value - 30) / 50) * 100;
                    element.style.background = '#4d96ff';
                    break;
                case 'soil':
                    percentage = ((value - 20) / 60) * 100;
                    element.style.background = '#51cf66';
                    break;
                case 'water':
                    percentage = (value / 50) * 100;
                    element.style.background = '#339af0';
                    break;
            }

            // Animate width change
            const targetWidth = Math.min(100, Math.max(0, percentage));
            element.style.width = targetWidth + '%';
        }

        // Update trend indicators
        function updateTrendIndicator(type, newValue) {
            const history = appState.sensorHistory[type];
            const element = document.getElementById(type + 'Trend');

            if (history.length > 1) {
                const previousValue = history[history.length - 1];
                const trend = newValue - previousValue;

                if (Math.abs(trend) < 0.1) {
                    element.textContent = '→';
                    element.style.color = '#666';
                } else if (trend > 0) {
                    element.textContent = '↗';
                    element.style.color = '#ff6b6b';
                } else {
                    element.textContent = '↘';
                    element.style.color = '#4d96ff';
                }
            }

            // Store in history (keep last 10 values)
            history.push(newValue);
            if (history.length > 10) history.shift();
        }

        // Enhanced status updates
        function updateSensorStatus(type, value) {
            const element = document.getElementById(type + 'Status');
            let status, color, bgColor;

            switch (type) {
                case 'temperature':
                    if (value > 35) { status = 'Panas'; color = '#ff6b6b'; bgColor = '#ff6b6b20'; }
                    else if (value < 20) { status = 'Dingin'; color = '#4d96ff'; bgColor = '#4d96ff20'; }
                    else { status = 'Optimal'; color = '#51cf66'; bgColor = '#51cf6620'; }
                    break;

                case 'humidity':
                    if (value > 70) { status = 'Basah'; color = '#4d96ff'; bgColor = '#4d96ff20'; }
                    else if (value < 40) { status = 'Kering'; color = '#ffa94d'; bgColor = '#ffa94d20'; }
                    else { status = 'Normal'; color = '#51cf66'; bgColor = '#51cf6620'; }
                    break;

                case 'soil':
                    if (value > 60) { status = 'Basah'; color = '#4d96ff'; bgColor = '#4d96ff20'; }
                    else if (value < 30) { status = 'Kering'; color = '#ffa94d'; bgColor = '#ffa94d20'; }
                    else { status = 'Optimal'; color = '#51cf66'; bgColor = '#51cf6620'; }
                    break;

                case 'water':
                    if (value > 40) { status = 'Tinggi'; color = '#4d96ff'; bgColor = '#4d96ff20'; }
                    else if (value < 10) { status = 'Rendah'; color = '#ff6b6b'; bgColor = '#ff6b6b20'; }
                    else { status = 'Normal'; color = '#51cf66'; bgColor = '#51cf6620'; }
                    break;
            }

            element.textContent = status;
            element.style.color = color;
            element.style.background = bgColor;
        }

        // System status update
        function updateSystemStatus(data) {
            if (data.pump) {
                const element = document.getElementById('pumpStatus');
                element.textContent = `Pompa: ${data.pump}`;
                element.style.color = data.pump === 'ON' ? '#51cf66' : '#ff6b6b';
            }

            if (data.mode) {
                const element = document.getElementById('modeStatus');
                element.textContent = data.mode;
                element.style.color = data.mode === 'AUTO' ? '#4d96ff' : '#ffd43b';
                appState.currentMode = data.mode;
            }
        }

        // Enhanced chart implementation
        let chartTempHum;
        const chartData = {
            labels: [],
            temperature: [],
            humidity: []
        };

        function initializeChart() {
            const ctx = document.getElementById('chartTempHum').getContext('2d');

            // Create gradients
            const tempGradient = ctx.createLinearGradient(0, 0, 0, 400);
            tempGradient.addColorStop(0, 'rgba(255, 107, 107, 0.4)');
            tempGradient.addColorStop(1, 'rgba(255, 107, 107, 0.05)');

            const humGradient = ctx.createLinearGradient(0, 0, 0, 400);
            humGradient.addColorStop(0, 'rgba(77, 150, 255, 0.4)');
            humGradient.addColorStop(1, 'rgba(77, 150, 255, 0.05)');

            chartTempHum = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Suhu (°C)',
                        data: chartData.temperature,
                        borderColor: '#ff6b6b',
                        backgroundColor: tempGradient,
                        tension: 0.4,
                        borderWidth: 3,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#ff6b6b',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }, {
                        label: 'Kelembapan (%)',
                        data: chartData.humidity,
                        borderColor: '#4d96ff',
                        backgroundColor: humGradient,
                        tension: 0.4,
                        borderWidth: 3,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#4d96ff',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 8,
                            padding: 12,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed.y.toFixed(1);
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        y: {
                            beginAtZero: false,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 12
                                },
                                callback: function(value) {
                                    return value + (this.scale.id === 'y' ? '°C' : '%');
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update chart data
        function updateChartData(data) {
            const now = new Date();
            const timeLabel = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            // Add new data
            chartData.labels.push(timeLabel);
            chartData.temperature.push(data.temperature);
            chartData.humidity.push(data.humidity);

            // Limit data points based on current range
            let maxPoints;
            switch (appState.chartRange) {
                case '1h': maxPoints = 60; break;  // 1 point per minute
                case '6h': maxPoints = 72; break;  // 1 point per 5 minutes
                case '24h': maxPoints = 96; break; // 1 point per 15 minutes
            }

            if (chartData.labels.length > maxPoints) {
                chartData.labels.shift();
                chartData.temperature.shift();
                chartData.humidity.shift();
            }

            // Update chart
            chartTempHum.update('active');
        }

        // Change chart time range
        function changeChartRange(range) {
            appState.chartRange = range;

            // Update button states
            document.querySelectorAll('.chart-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Here you would fetch historical data for the selected range
            // For now, we just adjust the data limit
            showToast(`Grafik diubah ke ${range}`, 'info');
        }

        // Enhanced table pagination
        let currentPage = 1;
        const itemsPerPage = 10;
        let allData = @json($data->toArray());

        function updateLogTable(data) {
            // Add new data to the beginning
            allData.unshift({
                created_at: new Date().toISOString(),
                temperature: data.temperature,
                humidity: data.humidity,
                soil: data.soil,
                water: data.water
            });

            // Keep only latest 100 records
            if (allData.length > 100) {
                allData = allData.slice(0, 100);
            }

            // Update current page
            showPage(currentPage);
            updatePaginationControls();
        }

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = allData.slice(start, end);

            const tbody = document.querySelector('.table-body-glass');
            tbody.innerHTML = '';

            pageData.forEach(item => {
                const date = new Date(item.created_at);
                const row = document.createElement('tr');
                row.className = 'table-row-glass';
                row.innerHTML = `
                    <td class="table-cell timestamp-cell">
                        <div class="time-main">${date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}</div>
                        <div class="time-sub">${date.toLocaleDateString('id-ID')}</div>
                    </td>
                    <td class="table-cell temperature-cell">
                        <span class="value">${item.temperature}</span>
                        <span class="unit">°C</span>
                    </td>
                    <td class="table-cell humidity-cell">
                        <span class="value">${item.humidity}</span>
                        <span class="unit">%</span>
                    </td>
                    <td class="table-cell soil-cell">
                        <span class="value">${item.soil}</span>
                        <span class="unit">%</span>
                    </td>
                    <td class="table-cell water-cell">
                        <span class="value">${item.water}</span>
                        <span class="unit">cm</span>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function updatePaginationControls() {
            const totalPages = Math.ceil(allData.length / itemsPerPage);
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');
            const pageInfo = document.getElementById('pageInfo');
            const totalPagesElement = document.querySelector('.total-pages');

            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
            pageInfo.textContent = `Halaman ${currentPage}`;
            totalPagesElement.textContent = `dari ${totalPages}`;
        }

        // Control functions with enhanced feedback
        function sendControlCommand(topic, command) {
            if (client.connected) {
                const payload = JSON.stringify({
                    command,
                    timestamp: new Date().toISOString(),
                    source: 'web_dashboard'
                });

                client.publish(topic, payload, { qos: 1 }, (err) => {
                    if (err) {
                        showToast('❌ Gagal mengirim perintah', 'error');
                    } else {
                        showToast(`✅ Perintah "${command}" terkirim`, 'success');

                        // Add visual feedback
                        const button = event.target.closest('.control-btn-3d');
                        if (button) {
                            button.classList.add('active');
                            setTimeout(() => button.classList.remove('active'), 500);
                        }
                    }
                });
            } else {
                showToast('⚠️ Tidak terhubung ke server', 'error');
            }
        }

        // Alert system
        function checkAlerts(data) {
            const alerts = [];

            if (data.temperature > 35) {
                alerts.push('Suhu terlalu tinggi!');
                showAlertBox('Suhu melebihi 35°C. Periksa sistem pendingin.');
            }

            if (data.soil < 20) {
                alerts.push('Tanah terlalu kering!');
                showAlertBox('Kelembapan tanah rendah. Pertimbangkan penyiraman.');
            }

            if (data.water < 5) {
                alerts.push('Air hampir habis!');
                showAlertBox('Ketinggian air kritis. Isi ulang tangki air.');
            }

            // Send alerts to MQTT if any
            if (alerts.length > 0) {
                client.publish(TOPICS.ALERTS, JSON.stringify({
                    alerts,
                    timestamp: new Date().toISOString()
                }));
            }
        }

        function showAlertBox(message) {
            const alertBox = document.getElementById('alertBox');
            const alertText = alertBox.querySelector('.alert-text');

            alertText.innerHTML = `<strong>Peringatan!</strong> ${message}`;
            alertBox.classList.remove('hidden');

            // Auto-hide after 10 seconds
            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 10000);
        }

        // Enhanced toast notifications
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.innerHTML = `
                <div class="toast-icon">
                    ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
                </div>
                <div class="toast-message">${message}</div>
            `;

            document.body.appendChild(toast);

            // Remove existing toasts
            const existingToasts = document.querySelectorAll('.toast-notification');
            if (existingToasts.length > 3) {
                existingToasts[0].remove();
            }

            // Auto remove
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        // Update last update time
        function updateLastUpdateTime() {
            const element = document.getElementById('lastUpdate');
            if (appState.lastUpdate) {
                const now = new Date();
                const diff = Math.floor((now - appState.lastUpdate) / 1000);

                if (diff < 60) {
                    element.textContent = `Terakhir update: ${diff} detik yang lalu`;
                } else if (diff < 3600) {
                    element.textContent = `Terakhir update: ${Math.floor(diff / 60)} menit yang lalu`;
                } else {
                    element.textContent = `Terakhir update: ${appState.lastUpdate.toLocaleTimeString('id-ID')}`;
                }
            }
        }

        // Utility functions
        function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        function refreshData() {
            showToast('🔄 Memperbarui data...', 'info');
            // Simulate data refresh
            setTimeout(() => {
                showToast('✅ Data diperbarui', 'success');
            }, 1000);
        }

        function forceRefresh() {
            location.reload();
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            showToast('🌙 Mode gelap diubah', 'info');
        }

        function showSettings() {
            showToast('⚙️ Pengaturan akan segera tersedia', 'info');
        }

        function exportChart() {
            const link = document.createElement('a');
            link.download = `smartfarm-chart-${new Date().toISOString().split('T')[0]}.png`;
            link.href = document.getElementById('chartTempHum').toDataURL('image/png');
            link.click();
            showToast('📥 Grafik berhasil diexport', 'success');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize chart
            initializeChart();

            // Initialize pagination
            showPage(currentPage);
            updatePaginationControls();

            // Add event listeners for controls
            document.getElementById('btnOn').addEventListener('click', () => sendControlCommand(TOPICS.CONTROL, 'ON'));
            document.getElementById('btnOff').addEventListener('click', () => sendControlCommand(TOPICS.CONTROL, 'OFF'));
            document.getElementById('btnAuto').addEventListener('click', () => sendControlCommand(TOPICS.MODE, 'AUTO'));
            document.getElementById('btnManual').addEventListener('click', () => sendControlCommand(TOPICS.MODE, 'MANUAL'));

            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                    updatePaginationControls();
                }
            });

            document.getElementById('nextPage').addEventListener('click', () => {
                const totalPages = Math.ceil(allData.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                    updatePaginationControls();
                }
            });

            // Close alert
            document.querySelector('.alert-close').addEventListener('click', () => {
                document.getElementById('alertBox').classList.add('hidden');
            });

            // Initial connection status
            connectionStatus.update('connecting', 0);

            // Start periodic updates
            setInterval(updateLastUpdateTime, 1000);

            // Simulate initial data
            setTimeout(() => {
                connectionStatus.update('connected', 95);
                updateLastUpdateTime();
            }, 2000);
        });

        // Fallback polling
        function pollData() {
            fetch('/api/sensors/latest')
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        updateSensorCardsWithAnimation(data);
                        updateChartData(data);
                        updateLogTable(data);
                    }
                })
                .catch(error => console.error('Polling error:', error));
        }

        // Start polling every 5 seconds as fallback
        setInterval(pollData, 5000);
    </script>
@endpush
