<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Farm Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial;
            margin: 20px
        }

        .controls {
            margin-bottom: 12px
        }

        button {
            padding: 8px 14px;
            margin-right: 6px
        }
    </style>
</head>

<body>
    <h2>Smart Farm Dashboard</h2>

    <div class="controls">
        <button id="btnOn">Turn Pump ON</button>
        <button id="btnOff">Turn Pump OFF</button>
    </div>

    <canvas id="chart" height="120"></canvas>

    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const cfg = {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                        label: 'Temperature (°C)',
                        data: [],
                        borderColor: '#ef6c00',
                        fill: false
                    },
                    {
                        label: 'Humidity (%)',
                        data: [],
                        borderColor: '#039be5',
                        fill: false
                    },
                    {
                        label: 'Soil (%)',
                        data: [],
                        borderColor: '#43a047',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true
            }
        };
        const chart = new Chart(ctx, cfg);

        // fetch data terbaru dari DB
        async function updateChart() {
            const res = await fetch('/api/sensor/recent/30');
            const arr = await res.json();
            cfg.data.labels = arr.map(r => r.created_at.split('T')[1].split('.')[0]);
            cfg.data.datasets[0].data = arr.map(r => r.temperature);
            cfg.data.datasets[1].data = arr.map(r => r.humidity);
            cfg.data.datasets[2].data = arr.map(r => r.soil);
            chart.update();
        }
        setInterval(updateChart, 5000); // update tiap 5 detik
        updateChart();

        // Kontrol pompa
        document.getElementById('btnOn').addEventListener('click', async () => {
            await fetch('/pump', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    cmd: 'ON'
                })
            });
            alert('Sent ON');
        });
        document.getElementById('btnOff').addEventListener('click', async () => {
            await fetch('/pump', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    cmd: 'OFF'
                })
            });
            alert('Sent OFF');
        });
    </script>
</body>

</html>
