<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>403 - Akses Ditolak (Pertanian)</title>
  <style>
    :root{
      --bg:#052e13; /* very dark green */
      --accent:#1fb45a; /* bright green */
      --muted:#88c99a;
      --glass: rgba(255,255,255,0.06);
      color-scheme: dark;
    }
    html,body{height:100%;margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial}
    body{background:linear-gradient(180deg,var(--bg) 0%, #06341a 60%);overflow:hidden;}

    /* canvas covers full viewport */
    #scene{position:fixed;inset:0;display:block;width:100%;height:100%;z-index:0}

    /* overlay UI */
    .overlay{
      position:relative;z-index:2;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px;gap:18px;
      pointer-events:none;
    }

    .card{
      pointer-events:auto;backdrop-filter: blur(6px) saturate(120%);background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));border-radius:18px;padding:28px 36px;box-shadow:0 10px 30px rgba(2,10,8,0.6);border:1px solid rgba(255,255,255,0.04);text-align:center;max-width:880px;width:calc(100% - 64px)
    }

    h1{font-size:clamp(40px,6vw,96px);margin:0;letter-spacing:-4px;line-height:0.9;color:transparent;
      -webkit-text-stroke:2px rgba(255,255,255,0.06);position:relative}

    /* highlight green fill using background-clip */
    h1 .fill{
      position:relative;display:inline-block;background:linear-gradient(90deg,var(--accent), #43d67e 60%);-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;}

    p.lead{margin:10px 0 16px;color:var(--muted);font-size:18px}

    .actions{display:flex;gap:12px;justify-content:center}
    .btn{appearance:none;border:0;padding:10px 18px;border-radius:12px;font-weight:600;cursor:pointer}
    .btn-primary{background:linear-gradient(90deg,var(--accent),#2dbb6d);color:#052e13;box-shadow:0 6px 18px rgba(47,180,100,0.18)}
    .btn-ghost{background:transparent;color:var(--muted);border:1px solid rgba(255,255,255,0.04)}

    .subtitle{font-size:13px;color:rgba(255,255,255,0.35);margin-top:10px}

    /* small footer note */
    .small{position:fixed;left:18px;bottom:18px;color:rgba(255,255,255,0.06);font-size:12px;z-index:2}

    /* subtle floating hint */
    .hint{position:fixed;right:18px;bottom:18px;color:var(--muted);background:var(--glass);padding:8px 10px;border-radius:10px;backdrop-filter:blur(6px);z-index:2}

    /* responsive */
    @media (max-width:600px){.card{padding:18px}.actions{flex-direction:column}.btn{width:100%}}
  </style>
</head>
<body>
  <canvas id="scene"></canvas>

  <div class="overlay">
    <div class="card" role="alert">
      <h1 aria-hidden="true"><span class="fill">403</span></h1>
      <p class="lead">Akses ditolak — Halaman ini tidak dapat dibuka karena keterbatasan akses pada sistem.</p>
      <div class="actions">
        <!-- Use data-action attributes instead of inline module-scoped onclick to avoid module scope issues -->
        <button class="btn btn-primary" data-action="home">Kembali ke Beranda</button>
        <button class="btn btn-ghost" data-action="contact">Minta Akses</button>
      </div>
      <div class="subtitle">Jika ini keliru, hubungi admin atau coba login dengan akun lain.</div>
    </div>
  </div>

  <div class="small">403 · Terlarang · Sistem</div>
  <div class="hint">Arahkan kursor untuk menggerakkan elemen pertanian</div>

  <script type="module">
    // Import three.js module via absolute URL so browser can resolve it
    import * as THREE from 'https://unpkg.com/three@0.150.1/build/three.module.js';

    const canvas = document.getElementById('scene');
    const renderer = new THREE.WebGLRenderer({canvas, antialias:true, alpha:true, powerPreference:'high-performance'});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));
    renderer.setSize(innerWidth, innerHeight);

    const scene = new THREE.Scene();

    scene.fog = new THREE.FogExp2(0x03260f, 0.06);

    const camera = new THREE.PerspectiveCamera(45, innerWidth/innerHeight, 0.1, 2000);
    camera.position.set(0, 12, 36);


    const hemi = new THREE.HemisphereLight(0x88f5c6, 0x06160a, 0.9);
    scene.add(hemi);
    const point = new THREE.PointLight(0x8ef59b, 1.6, 120);
    point.position.set(10, 30, 20);
    scene.add(point);

    const farmland = new THREE.Mesh(
      new THREE.CircleGeometry(40, 32),
      new THREE.MeshStandardMaterial({color:0x0a3d1c, roughness:0.95})
    );
    farmland.rotation.x = -Math.PI/2;
    farmland.position.y = -8;
    scene.add(farmland);

    const sprout = new THREE.Group();
    const stem = new THREE.Mesh(
      new THREE.CylinderGeometry(0.2, 0.2, 3, 12),
      new THREE.MeshStandardMaterial({color:0x2ebf5a})
    );
    stem.position.y = 1.5;
    sprout.add(stem);

    const leafGeo = new THREE.PlaneGeometry(2,1);
    const leafMat = new THREE.MeshStandardMaterial({color:0x33cc66, side:THREE.DoubleSide});
    const leaf1 = new THREE.Mesh(leafGeo, leafMat);
    leaf1.position.set(0.9,2,0);
    leaf1.rotation.z = 0.6;
    sprout.add(leaf1);

    const leaf2 = new THREE.Mesh(leafGeo, leafMat);
    leaf2.position.set(-0.9,2,0);
    leaf2.rotation.z = -0.6;
    sprout.add(leaf2);

    sprout.position.set(0,-5,0);
    scene.add(sprout);

    const tractor = new THREE.Group();

    const body = new THREE.Mesh(
      new THREE.BoxGeometry(6,3,4),
      new THREE.MeshStandardMaterial({color:0x1f7a2e, roughness:0.8})
    );
    body.position.y = -4.5;
    tractor.add(body);

    const cabin = new THREE.Mesh(
      new THREE.BoxGeometry(3,3,3),
      new THREE.MeshStandardMaterial({color:0x14531d, roughness:0.7})
    );
    cabin.position.set(0, -2.5, 0);
    tractor.add(cabin);

    // wheels
    function makeWheel(){
      return new THREE.Mesh(
        new THREE.CylinderGeometry(1.4,1.4,1,16),
        new THREE.MeshStandardMaterial({color:0x222222, roughness:0.9})
      );
    }

    const w1 = makeWheel(); w1.rotation.z = Math.PI/2; w1.position.set(-2.5,-6,2);
    const w2 = makeWheel(); w2.rotation.z = Math.PI/2; w2.position.set(2.5,-6,2);
    const w3 = makeWheel(); w3.rotation.z = Math.PI/2; w3.position.set(-2.5,-6,-2);
    const w4 = makeWheel(); w4.rotation.z = Math.PI/2; w4.position.set(2.5,-6,-2);

    tractor.add(w1,w2,w3,w4);

    // position tractor
    tractor.position.set(-10,0,10);
    scene.add(tractor);

    // expose tractor for debugging
    window._tractor = tractor;

    // a subtle background particle field (small floating dust/seed particles)
    const partCount = 600;
    const positions = new Float32Array(partCount*3);
    for(let i=0;i<partCount;i++){
      positions[i*3] = (Math.random()-0.5)*220;
      positions[i*3+1] = (Math.random()-0.5)*120;
      positions[i*3+2] = (Math.random()-0.5)*220;
    }
    const partGeo = new THREE.BufferGeometry();
    partGeo.setAttribute('position', new THREE.BufferAttribute(positions,3));
    const partMat = new THREE.PointsMaterial({size:0.8, transparent:true, opacity:0.9, depthWrite:false});
    partMat.color = new THREE.Color(0x2fe08a);
    const particles = new THREE.Points(partGeo, partMat);
    scene.add(particles);

    // container group for seeds
    const group = new THREE.Group();
    scene.add(group);

    // create floating "benih" (seed) spheres with earthy-green color tones
    const seedGeo = new THREE.SphereGeometry(1, 22, 22);
    const seedMat = new THREE.MeshStandardMaterial({color:0x7c5a28, metalness:0.2, roughness:0.9, emissive:0x1a2f12, emissiveIntensity:0.3});

    const seeds = [];
    for(let i=0;i<100;i++){
      const m = new THREE.Mesh(seedGeo, seedMat.clone());
      const s = Math.random()*1.4 + 0.4;
      m.scale.setScalar(s);
      m.position.set((Math.random()-0.5)*50, (Math.random()-0.5)*28, (Math.random()-0.5)*50);
      m.rotation.set(Math.random()*Math.PI, Math.random()*Math.PI, Math.random()*Math.PI);
      // small color variation
      m.material.color.offsetHSL(0, Math.random()*0.08, Math.random()*0.1);
      group.add(m);
      seeds.push({mesh:m, speed:0.18+Math.random()*0.6, rotSpeed:Math.random()*0.02});
    }

    // pointer for parallax
    let pointer = {x:0,y:0};
    window.addEventListener('pointermove', (e)=>{
      pointer.x = (e.clientX / innerWidth) * 2 - 1;
      pointer.y = (e.clientY / innerHeight) * 2 - 1;
    });

    function resize(){
      camera.aspect = innerWidth/innerHeight; camera.updateProjectionMatrix(); renderer.setSize(innerWidth, innerHeight);
    }
    addEventListener('resize', resize);

    // animation loop
    const clock = new THREE.Clock();
    function animate(){
      const t = clock.getElapsedTime();

      // animate seeds
      for(let i=0;i<seeds.length;i++){
        const s = seeds[i];
        s.mesh.rotation.x += 0.002 + s.rotSpeed*0.02;
        s.mesh.rotation.y += 0.001 + s.rotSpeed*0.01;
        s.mesh.position.y += Math.sin(t * s.speed + i) * 0.01; // more visible bob
      }

      // camera subtle parallax based on pointer (manual, no OrbitControls)
      const targetX = pointer.x * 6;
      const targetY = -pointer.y * 3 + 6;
      camera.position.x += (targetX - camera.position.x) * 0.06;
      camera.position.y += (targetY - camera.position.y) * 0.06;
      camera.lookAt(0,6,0);

      // animate tractor wheels
      w1.rotation.x += 0.08;
      w2.rotation.x += 0.08;
      w3.rotation.x += 0.08;
      w4.rotation.x += 0.08;

      // move tractor in circular path
      const radius = 18;
      const speed = 0.3;
      const angle = t * speed;
      tractor.position.x = Math.cos(angle) * radius;
      tractor.position.z = Math.sin(angle) * radius;
      tractor.rotation.y = -angle + Math.PI/2;

      // rotate overall group slowly
      group.rotation.y += 0.0025;

      // particles faint drift
      particles.rotation.y = t * 0.01;

      renderer.render(scene, camera);
      requestAnimationFrame(animate);
    }
    animate();

    // small helpers for buttons
    // Because this script is a module, regular function declarations are module-scoped and not reachable
    // from inline onclick attributes. Attach handlers to window or, better, use event listeners on elements.
    window.goHome = function(){ window.location.href = '/'; };
    window.contact = function(){ alert('Minta akses: Hubungi Admin atau kirim Permintaan Resmi Anda.'); };

    // Connect the buttons (data-action) to the module-scoped handlers
    document.querySelectorAll('[data-action]').forEach(btn => {
      const action = btn.getAttribute('data-action');
      btn.addEventListener('click', () => {
        if(action === 'home') window.goHome();
        if(action === 'contact') window.contact();
      });
    });

    // expose for debugging (optional)
    window._threeScene = {scene, camera, renderer};

  </script>
</body>
</html>
