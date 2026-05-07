<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("location:login.php");
    exit();
}
include 'koneksi.php';

$id_laporan = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM laporan WHERE id_laporan = '$id_laporan' AND id_user = '{$_SESSION['id_user']}'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("location:dashboard_mhs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan — Foundly.</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: rgba(255, 255, 255, 0.4);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-radius: 40px;
            padding: 45px;
            width: 100%;
            max-width: 550px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 40px 100px rgba(0,0,0,0.08);
            animation: cardUp 0.8s ease-out;
        }

        h2 {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: rgba(0,0,0,0.6);
            margin-left: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 15px 20px;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            background: rgba(255,255,255,0.5);
            font-size: 14px;
            font-weight: 600;
            outline: none;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            background: #fff;
            border-color: #6366f1;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.05);
        }

        .btn-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-save {
            background: #6366f1;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 20px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-save:hover {
            background: #4f46e5;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.2);
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            text-align: center;
            padding: 15px;
            border-radius: 20px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        @keyframes cardUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="glass-card">
        <h2>Edit Laporan</h2>
        <form action="proses_edit_laporan.php" method="POST">
            <input type="hidden" name="id_laporan" value="<?php echo $data['id_laporan']; ?>">
            
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required>
            </div>

            <div class="form-group">
                <label>Lokasi Terakhir</label>
                <input type="text" name="lokasi" value="<?php echo $data['lokasi']; ?>" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Tambahan</label>
                <textarea name="deskripsi" rows="4" required><?php echo $data['deskripsi']; ?></textarea>
            </div>

            <div class="btn-container">
                <a href="dashboard_mhs.php" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>