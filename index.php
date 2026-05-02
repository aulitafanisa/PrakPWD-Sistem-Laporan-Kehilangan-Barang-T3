<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundly - Sistem Laporan Barang Hilang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #0a0a0a;
            overflow-x: hidden;
            line-height: 1.5;
        }

        .gradient-sphere {
            position: fixed;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, rgba(168, 85, 247, 0.05) 30%, transparent 70%);
            top: -40vw;
            right: -20vw;
            z-index: -1;
            filter: blur(100px);
            animation: float 20s infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-50px, 50px); }
        }

        nav {
            padding: 24px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .logo {
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo::before {
            content: '';
            width: 12px;
            height: 12px;
            background: #6366f1;
            border-radius: 3px;
        }

        .btn-signin {
            background: #0a0a0a;
            color: white;
            padding: 10px 24px;
            border-radius: 99px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-signin:hover {
            transform: scale(1.05);
            background: #222;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 8% 60px;
        }

        .badge {
            background: rgba(99, 102, 241, 0.08);
            color: #6366f1;
            padding: 8px 16px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 32px;
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .hero h1 {
            font-size: clamp(48px, 8vw, 90px);
            font-weight: 800;
            letter-spacing: -4px;
            line-height: 0.9;
            margin-bottom: 32px;
            background: linear-gradient(to bottom, #000 60%, #666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 20px;
            color: #555;
            max-width: 580px;
            margin-bottom: 48px;
            font-weight: 400;
        }

        .btn-group {
            display: flex;
            gap: 16px;
        }

        .btn-main {
            background: #0a0a0a;
            color: white;
            padding: 18px 40px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .btn-outline {
            background: white;
            color: #0a0a0a;
            padding: 18px 40px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
        }

        .btn-main:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 8%;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .card {
            padding: 48px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 40px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-10px);
            background: white;
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: 0 40px 80px rgba(0,0,0,0.05);
        }

        .card h3 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .card p {
            color: #666;
            font-size: 15px;
            line-height: 1.7;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background: #0a0a0a;
            border-radius: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
</head>
<body>

    <div class="gradient-sphere"></div>

    <nav>
        <div class="logo">Foundly.</div>
        <a href="login.php" class="btn-signin">Sign In</a>
    </nav>

    <section class="hero">
        <div class="badge">SMART LOST & FOUND SYSTEM</div>
        <h1>Lost it? We'll help <br> you find it.</h1>
        <p>Platform cerdas untuk melaporkan dan mencari barang hilang di kampus dengan transparansi penuh.</p>
        <div class="btn-group">
            <a href="login.php" class="btn-main">Get Started</a>
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
                <p>Setiap laporan divalidasi oleh petugas untuk memastikan keamanan barang berharga anda.</p>
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