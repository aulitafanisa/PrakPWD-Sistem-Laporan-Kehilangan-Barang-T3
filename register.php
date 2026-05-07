<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Foundly — Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-image: url('uploads/bg.png'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
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

        .register-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
            perspective: 1000px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            padding: 50px 40px;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.1);
            animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin-bottom: 8px;
            text-align: center;
            color: #000;
        }

        p.subtitle {
            color: rgba(0, 0, 0, 0.5);
            font-size: 15px;
            margin-bottom: 35px;
            text-align: center;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 22px;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.3s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }
        .form-group:nth-child(3) { animation-delay: 0.5s; }

        label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 10px;
            margin-left: 5px;
            color: rgba(0, 0, 0, 0.7);
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        input {
            width: 100%;
            padding: 16px 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
            color: #000;
        }

        input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        input:focus {
            background: #fff;
            border-color: #6366f1;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .btn-register {
            width: 100%;
            background: #000;
            color: white;
            padding: 18px;
            border-radius: 22px;
            border: none;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out 0.7s forwards;
        }

        .btn-register:hover {
            background: #333;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: rgba(0, 0, 0, 0.4);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out 0.9s forwards;
        }

        .login-link span { 
            color: #6366f1; 
            font-weight: 700;
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(40px) rotateX(-10deg); filter: blur(10px); }
            to { opacity: 1; transform: translateY(0) rotateX(0); filter: blur(0); }
        }

        @keyframes fadeInBlur {
            from { opacity: 0; filter: blur(5px); transform: translateY(10px); }
            to { opacity: 1; filter: blur(0); transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .register-card { padding: 40px 25px; border-radius: 30px; }
            h2 { font-size: 28px; }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <h2>Create Account</h2>
            <p class="subtitle">Daftar sekarang untuk mulai menggunakan Foundly.</p>

            <form action="proses_register.php" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap..." required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Buat username unik..." required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter..." required>
                </div>

                <input type="hidden" name="role" value="mahasiswa">

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <a href="login.php" class="login-link">Sudah punya akun? <span>Login di sini</span></a>
        </div>
    </div>
</body>
</html>