<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundly - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
        }
        h2 {
            font-weight: 800;
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }
        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
            margin-left: 5px;
        }

        input {
            width: 100%;
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid #ddd;
            outline: none;
            transition: 0.3s;
            background: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        input:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 4px rgba(110, 142, 251, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: #1a1a1a; /* Hitam elegan sesuai desain Framer[cite: 17] */
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .error-msg {
            background: #ffe5e5;
            color: #d9534f;
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Halo, Welcome To Foundly</h2>
        <p>Sistem Laporan Kehilangan Barang</p>

        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
            <div class="error-msg">Username atau password salah.</div>
        <?php endif;?>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit">Log In</button>
        </form>


    </div>
</body>
</html>