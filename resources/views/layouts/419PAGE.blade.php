<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>419 — Session Expired</title>
    <style>
        :root {
            --accent: #6ee7b7;
            --glass: #0b1220cc
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, Segoe UI, Roboto, 'Helvetica Neue', Arial
        }

        body {
            background: #052;
            color: #e6f0ff;
            overflow: hidden
        }

        #overlay {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .card {
            pointer-events: auto;
            backdrop-filter: blur(6px) saturate(120%);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
            border: 1px solid rgba(255, 255, 255, 0.06);
            padding: 28px 36px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(2, 6, 23, 0.6);
            max-width: 760px;
            width: 86%;
            text-align: left
        }

        h1 {
            margin: 0 0 6px;
            font-size: 28px;
            letter-spacing: 0.6px
        }

        p {
            margin: 0 0 12px;
            color: #cde9ffcc
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 8px
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 0;
            cursor: pointer;
            background: linear-gradient(90deg, var(--accent), #60a5fa);
            color: #021;
            font-weight: 600
        }

        .btn.ghost {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.07);
            color: #e6f0ff
        }

        .small {
            font-size: 13px;
            color: #bcd6ffcc;
            margin-top: 8px
        }

        #hint {
            font-size: 12px;
            color: #9fb7ff88
        }

        canvas {
            display: block
        }

        /* mobile adjustments */
        @media (max-width:600px) {
            .card {
                padding: 18px;
                border-radius: 12px;
                width: 94%;
            }

            h1 {
                font-size: 20px
            }
        }
    </style>
</head>

<body>
    <canvas id="c"></canvas>

    <div id="overlay">
        <div class="card" role="alert" aria-labelledby="title">
            <div style="display:flex;align-items:center;gap:16px">
                <div
                    style="width:64px;height:64px;border-radius:12px;background:linear-gradient(135deg,#1f2937,#0b1220);display:flex;align-items:center;justify-content:center;box-shadow:0 6px 18px rgba(0,0,0,0.6)">
                    <!-- simple SVG icon -->
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" aria-hidden>
                        <path d="M4 12h16" stroke="url(#g)" stroke-width="1.6" stroke-linecap="round" />
                        <defs>
                            <linearGradient id="g" x1="0" x2="1">
                                <stop offset="0" stop-color="#7af0c6" />
                                <stop offset="1" stop-color="#7ea8ff" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div>
                    <h1 id="title">419 — Session Expired</h1>
                    <p>Sepertinya sesi Anda telah berakhir. Silakan muat ulang atau kembali ke beranda.</p>
                    <div class="actions">
                        <button class="btn" id="reload">Muat Ulang</button>
                        <button class="btn ghost" id="home">Ke Beranda</button>
                        <button class="btn ghost" id="regen">Regenerate Stars</button>
                    </div>
                    <div class="small" id="hint">Geser/gerakkan kursor untuk mengubah tampilan. Ketuk layar untuk
                        membuat gelombang.</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/three@0.153.0/build/three.min.js"></script>
    <script>
        // Basic Three.js 3D interactive 'space' for 419 page
        const canvas = document.getElementById('c');
        const renderer = new THREE.WebGLRenderer({
            canvas,
            antialias: true,
            alpha: true
        });
        renderer.setPixelRatio(window.devicePixelRatio);

        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(0x001a00, 0.0006);

        const camera = new THREE.PerspectiveCamera(50, 2, 0.1, 2000);
        camera.position.set(0, 0, 220);

        // responsive
        function resize() {
            const w = window.innerWidth,
                h = window.innerHeight;
            renderer.setSize(w, h);
            camera.aspect = w / h;
            camera.updateProjectionMatrix();
        }
        window.addEventListener('resize', resize, {
            passive: true
        });
        resize();

        // star field as points
        let stars;

        function makeStars(count = 4000) {
            if (stars) scene.remove(stars);
            const geom = new THREE.BufferGeometry();
            const positions = new Float32Array(count * 3);
            const sizes = new Float32Array(count);
            for (let i = 0; i < count; i++) {
                const r = 600 * Math.random() + 20;
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.acos((Math.random() * 2) - 1);
                const x = r * Math.sin(phi) * Math.cos(theta);
                const y = r * Math.sin(phi) * Math.sin(theta);
                const z = r * Math.cos(phi);
                positions[i * 3] = x;
                positions[i * 3 + 1] = y;
                positions[i * 3 + 2] = z;
                sizes[i] = Math.random() * 1.2 + 0.2;
            }
            geom.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            geom.setAttribute('size', new THREE.BufferAttribute(sizes, 1));

            const material = new THREE.PointsMaterial({
                size: 1.6,
                sizeAttenuation: true,
                color: 0xddeeff,
                transparent: true,
                opacity: 0.95
            });
            stars = new THREE.Points(geom, material);
            scene.add(stars);
        }
        makeStars();

        // drifting planet (simple sphere)
        const planetMat = new THREE.MeshStandardMaterial({
            color: 0x213a6b,
            metalness: 0.3,
            roughness: 0.7,
            emissive: 0x091023,
            emissiveIntensity: 0.4
        });
        const planet = new THREE.Mesh(new THREE.SphereGeometry(38, 48, 32), planetMat);
        planet.position.set(-120, -30, -200);
        scene.add(planet);

        // small floating debris
        const debrisGroup = new THREE.Group();
        for (let i = 0; i < 40; i++) {
            const m = new THREE.Mesh(new THREE.IcosahedronGeometry(1.8 + Math.random() * 3, 0), new THREE
                .MeshStandardMaterial({
                    color: 0x8fb3ff,
                    roughness: 0.9,
                    metalness: 0.1
                }))
            m.position.set((Math.random() - 0.5) * 300, (Math.random() - 0.5) * 200, (Math.random() - 0.5) * 400);
            m.rotation.set(Math.random() * 2, Math.random() * 2, Math.random() * 2);
            debrisGroup.add(m);
        }
        scene.add(debrisGroup);

        // lights
        const hemi = new THREE.HemisphereLight(0xbcdfff, 0x080820, 0.6);
        scene.add(hemi);
        const dir = new THREE.DirectionalLight(0xa6d6ff, 0.9);
        dir.position.set(120, 60, 100);
        scene.add(dir);

        // parallax on mouse
        const mouse = {
            x: 0,
            y: 0
        };

        function onMove(e) {
            const x = (e.touches ? e.touches[0].clientX : e.clientX) - window.innerWidth / 2;
            const y = (e.touches ? e.touches[0].clientY : e.clientY) - window.innerHeight / 2;
            mouse.x = x / window.innerWidth;
            mouse.y = y / window.innerHeight;
        }
        window.addEventListener('mousemove', onMove);
        window.addEventListener('touchmove', onMove, {
            passive: true
        });

        // click/tap wave effect (push nearby stars)
        function poke(x, y) {
            const v = new THREE.Vector3((x / window.innerWidth) * 2 - 1, -(y / window.innerHeight) * 2 + 1, 0.5);
            v.unproject(camera);
            const dir = v.sub(camera.position).normalize();
            const distance = -camera.position.z / dir.z;
            const pos = camera.position.clone().add(dir.multiplyScalar(distance));
            // apply a simple displacement to nearest points
            const attr = stars.geometry.attributes.position;
            for (let i = 0; i < attr.count; i++) {
                const px = attr.array[i * 3],
                    py = attr.array[i * 3 + 1],
                    pz = attr.array[i * 3 + 2];
                const dx = px - pos.x,
                    dy = py - pos.y,
                    dz = pz - pos.z;
                const d = Math.sqrt(dx * dx + dy * dy + dz * dz);
                if (d < 120) {
                    const push = (120 - d) / 120 * 10;
                    attr.array[i * 3] += dx / d * push;
                    attr.array[i * 3 + 1] += dy / d * push;
                    attr.array[i * 3 + 2] += dz / d * push;
                }
            }
            attr.needsUpdate = true;
        }
        window.addEventListener('click', (e) => poke(e.clientX, e.clientY));
        window.addEventListener('touchstart', (e) => {
            if (e.touches) poke(e.touches[0].clientX, e.touches[0].clientY);
        }, {
            passive: true
        });

        // small animation loop
        let t = 0;

        function animate() {
            t += 0.005;
            // camera slight float following mouse
            camera.position.x += (mouse.x * 80 - camera.position.x) * 0.05;
            camera.position.y += (mouse.y * -60 - camera.position.y) * 0.05;
            camera.lookAt(0, 0, 0);

            planet.rotation.y += 0.0025;
            debrisGroup.rotation.y += 0.001 + Math.sin(t) / 200;

            // gentle inward drift for stars to create depth
            if (stars) {
                stars.rotation.y += 0.0008;
            }

            renderer.render(scene, camera);
            requestAnimationFrame(animate);
        }
        animate();

        // UI actions
        document.getElementById('reload').addEventListener('click', () => location.reload());
        document.getElementById('home').addEventListener('click', () => location.href = '/');
        document.getElementById('regen').addEventListener('click', () => makeStars(3000 + Math.floor(Math.random() *
        5000)));

        // accessibility: keyboard reload (R)
        window.addEventListener('keydown', (e) => {
            if (e.key.toLowerCase() === 'r') location.reload();
        });

        // initial hint fade
        setTimeout(() => {
            const h = document.getElementById('hint');
            h.style.opacity = 0.9;
        }, 400);
    </script>
</body>

</html>
