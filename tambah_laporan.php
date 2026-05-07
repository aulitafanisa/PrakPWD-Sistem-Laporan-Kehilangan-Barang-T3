<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("location:login.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Barang Hilang — Foundly.</title>
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
            padding: 40px 20px;
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

        .form-container {
            width: 100%;
            max-width: 580px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            padding: 50px 45px;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 40px 100px rgba(0,0,0,0.1);
            animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin-bottom: 10px;
            color: #000;
        }

        .form-header p {
            color: rgba(0,0,0,0.5);
            font-size: 15px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 22px;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.5s; }

        label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
            margin-left: 5px;
            color: rgba(0, 0, 0, 0.7);
        }

        input, textarea {
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

        input:focus, textarea:focus {
            background: #fff;
            border-color: #6366f1;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        textarea {
            resize: none;
            height: 110px;
        }

        input[type="file"] {
            padding: 12px;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
        }

        .btn-submit {
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
            margin-top: 15px;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out 0.6s forwards;
        }

        .btn-submit:hover {
            background: #333;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 25px;
            text-decoration: none;
            color: rgba(0, 0, 0, 0.4);
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            opacity: 0;
            animation: fadeInBlur 0.6s ease-out 0.8s forwards;
        }

        .btn-back:hover { color: #000; }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(30px); filter: blur(10px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        @keyframes fadeInBlur {
            from { opacity: 0; filter: blur(5px); transform: translateY(10px); }
            to { opacity: 1; filter: blur(0); transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .form-container { padding: 40px 25px; }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Lapor Barang</h1>
            <p>Berikan detail barang yang hilang sejelas mungkin.</p>
        </div>

        <form action="simpan_laporan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" placeholder="Contoh: AirPods Pro 2" required>
            </div>

            <div class="form-group">
                <label>Lokasi Terakhir</label>
                <input type="text" name="lokasi" placeholder="Contoh: Kantin Teknik Lt. 1" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Tambahan</label>
                <textarea name="deskripsi" placeholder="Warna, ciri khas, atau detail lainnya..."></textarea>
            </div>

            <div class="form-group">
                <label>Foto Barang (Opsional)</label>
                <input type="file" name="foto_barang" accept="image/*">
            </div>

            <button type="submit" class="btn-submit">Kirim Laporan</button>
            <a href="dashboard_mhs.php" class="btn-back">← Batal dan Kembali</a>
        </form>
    </div>
</body>
</html>