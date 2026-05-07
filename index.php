<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundly — Sistem Cerdas Laporan Barang Hilang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-image: url('uploads/bg.png'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
            background-repeat: no-repeat;
            color: #0a0a0a;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: rgba(255, 255, 255, 0.1); 
        }

        nav {
            margin: 25px auto;
            padding: 10px 15px 10px 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 90%;
            max-width: 1200px;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(200%);
            -webkit-backdrop-filter: blur(25px) saturate(200%);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.03);
            animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .logo {
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -1.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo::before {
            content: '';
            width: 12px;
            height: 12px;
            background: #6366f1;
            border-radius: 4px;
        }

        .nav-btns {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-reg {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            font-weight: 700;
            padding: 10px 20px;
        }

        .btn-signin {
            background: #000;
            color: #fff;
            padding: 10px 28px;
            border-radius: 99px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-signin:hover { background: #333; transform: scale(1.05); }

        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 150px 5% 100px;
            position: relative;
        }

        .hero .badge {
            background: rgba(99, 102, 241, 0.08);
            color: #6366f1;
            padding: 8px 18px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-top: 120px;
            margin-bottom: 40px;
            text-transform: uppercase;
            border: 1px solid rgba(99, 102, 241, 0.15);
            animation: fadeInBlur 1s ease-out 0.2s both;
        }

        .hero h1 {
            font-size: clamp(48px, 7vw, 85px);
            font-weight: 800;
            letter-spacing: -4px;
            line-height: 0.95;
            margin-bottom: 30px;
            color: #000;
            max-width: 900px;
            animation: fadeInBlur 1s ease-out 0.4s both;
        }

        .hero p {
            font-size: 19px;
            color: rgba(0,0,0,0.6);
            max-width: 600px;
            margin-bottom: 50px;
            font-weight: 500;
            line-height: 1.6;
            animation: fadeInBlur 1s ease-out 0.6s both;
        }

        .btn-group {
            display: flex;
            gap: 20px;
            animation: fadeInBlur 1s ease-out 0.8s both;
        }

        .floating-arc-container {
            position: absolute;
            top: 20%;
            transform: translate(-50%, -50%);
            width: 900px;
            z-index: -1;
            animation: fadeInBlur 1.5s ease-out 1s both;
        }

        .arc-item {
            position: absolute;
            top: 0;
            left: 50%;
            width: 75px;
            height: 75px;
            margin-left: -37.5px;
            transform-origin: 50% 550px;
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-circle {
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            animation: floatUpDown 3s ease-in-out infinite alternate;
        }

        .glass-circle img {
            width: 100%;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        }

        .item-1 .glass-circle { animation-delay: 0s; }
        .item-2 .glass-circle { animation-delay: 0.4s; }
        .item-3 .glass-circle { animation-delay: 0.8s; }
        .item-4 .glass-circle { animation-delay: 1.2s; }
        .item-5 .glass-circle { animation-delay: 1.6s; }

        .item-1 { transform: rotate(-30deg); }
        .item-2 { transform: rotate(-15deg); }
        .item-3 { transform: rotate(0deg); }
        .item-4 { transform: rotate(15deg); }
        .item-5 { transform: rotate(30deg); }

        @keyframes slideDown {
            from { transform: translate(-50%, -100%); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }

        @keyframes fadeInBlur {
            from { opacity: 0; filter: blur(10px); transform: translateY(20px); }
            to { opacity: 1; filter: blur(0); transform: translateY(0); }
        }

        @keyframes floatUpDown {
            from { transform: translateY(0); }
            to { transform: translateY(-15px); }
        }

        .btn-main, .btn-outline {
            padding: 18px 45px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-main {
            background: #000;
            color: #fff;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.6);
            color: #000;
            border: 1px solid #e2e8f0;
            backdrop-filter: blur(10px);
        }

        .btn-main:hover { background: #333; transform: translateY(-3px); }
        .btn-outline:hover { background: #fff; transform: translateY(-3px); }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5% 120px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            animation: fadeInBlur 1s ease-out 1.2s both;
        }

        .card {
            padding: 50px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 45px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 40px 80px rgba(0,0,0,0.05);
        }

        .card h3 { font-size: 26px; font-weight: 800; margin-bottom: 18px; color: #000; }
        .card p { color: rgba(0,0,0,0.6); line-height: 1.7; font-weight: 500; }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #000;
            border-radius: 18px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
        }

        @media (max-width: 768px) {
            .floating-arc-container { display: none; }
            .hero { padding-top: 180px; }
            .btn-group { flex-direction: column; width: 100%; }
            nav { width: 95%; padding-left: 20px; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Foundly.</div>
        <div class="nav-btns">
            <a href="register.php" class="btn-reg">Register</a>
            <a href="login.php" class="btn-signin">Sign In</a>
        </div>
    </nav>

    <section class="hero">
        <div class="badge">Sistem Lost & Found Cerdas Kampus</div>

        <h1>Lost it? We'll help <br>you find it.</h1>

        <div class="floating-arc-container">
            <div class="arc-item item-1">
                <div class="glass-circle"><img src="uploads/wallet.png" alt="Wallet"></div>
            </div>
            <div class="arc-item item-2">
                <div class="glass-circle"><img src="uploads/airpods.png" alt="Airpods"></div>
            </div>
            <div class="arc-item item-3">
                <div class="glass-circle"><img src="uploads/tumbler.png" alt="Tumbler"></div>
            </div>
            <div class="arc-item item-4">
                <div class="glass-circle"><img src="uploads/keys.png" alt="Keys"></div>
            </div>
            <div class="arc-item item-5">
                <div class="glass-circle"><img src="uploads/notebook.png" alt="Notebook"></div>
            </div>
        </div>

        <p>Platform cerdas untuk melaporkan dan mencari barang hilang di kampus dengan transparansi penuh.</p>
        
        <div class="btn-group">
            <a href="register.php" class="btn-main">Get Started</a>
            <a href="#features" class="btn-outline">How it works</a>
        </div>
    </section>

    <div class="container" id="features">
        <div class="grid">
            <div class="card">
                <div class="icon-box">✦</div>
                <h3>Organized</h3>
                <p>Data barang hilang diarsipkan dengan rapi agar mudah ditemukan oleh siapa pun.</p>
            </div>
            <div class="card">
                <div class="icon-box">⚡</div>
                <h3>Verified</h3>
                <p>Setiap laporan divalidasi oleh petugas untuk memastikan keamanan barang berharga Anda.</p>
            </div>
            <div class="card">
                <div class="icon-box">⚓</div>
                <h3>Real-time</h3>
                <p>Dapatkan update status laporanmu secara langsung melalui dashboard interaktif.</p>
            </div>
        </div>
    </div>
</body>
</html>