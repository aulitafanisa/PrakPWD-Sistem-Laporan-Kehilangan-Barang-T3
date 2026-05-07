<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("location:login.php?pesan=belum_login");
    exit();
}
include 'koneksi.php';
$nama_user = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa — Foundly.</title>
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
            color: #000;
            min-height: 100vh;
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

        nav {
            margin: 25px auto;
            padding: 12px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            width: 90%;
            max-width: 1200px;
            top: 25px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            z-index: 1000;
            animation: slideDown 0.8s ease-out;
        }

        .logo { font-weight: 800; font-size: 22px; letter-spacing: -1.5px; }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile span { font-size: 14px; font-weight: 600; }

        .btn-logout {
            background: #000;
            color: white;
            padding: 10px 24px;
            border-radius: 99px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #333;
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 5%;
        }

        .welcome-section {
            margin-bottom: 50px;
            animation: fadeIn 1s ease-out;
        }

        .welcome-section h1 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 8px;
        }

        .welcome-section p {
            color: rgba(0,0,0,0.5);
            font-weight: 500;
        }

        .main-grid {
            display: block;
            width: 100%;
        }

        .card-action {
        margin: 0 auto 40px auto;
        width: 100%;
        max-width: 480px;
        padding: 50px 30px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 40px 100px rgba(0,0,0,0.05);
        text-align: center;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        }
    

        .card-action:hover {
        transform: translateY(-12px) scale(1.02);
        background: rgba(255, 255, 255, 0.35);
        box-shadow: 0 50px 120px rgba(0,0,0,0.1);
        border: 1px solid rgba(255, 255, 255, 0.6); 
        }

        .btn-add {
            display: block;
            background: #6366f1;
            color: white;
            padding: 18px;
            border-radius: 22px;
            text-decoration: none;
            font-weight: 700;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #4f46e5;
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
        }

        .history-section {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            padding: 40px;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 40px 100px rgba(0,0,0,0.05);
            animation: cardUp 1s ease-out;
        }

        .history-section h2 {
            margin-bottom: 30px;
            font-weight: 800;
            letter-spacing: -1.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(0,0,0,0.4);
            font-weight: 800;
        }

        td {
            padding: 20px 15px;
            border-top: 1px solid rgba(0,0,0,0.05);
            font-size: 14px;
            font-weight: 600;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .status-pending { background: #fff4e5; color: #ff8c00; }
        .status-found { background: #e7f9ed; color: #2ecc71; }

        .btn-edit { color: #6366f1; text-decoration: none; font-weight: 800; margin-right: 15px; }
        .btn-delete { color: #ff4757; text-decoration: none; font-weight: 800; }

        .item-thumb {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            object-fit: cover;
            background: #eee;
            margin-right: 12px;
            vertical-align: middle;
        }

        @keyframes slideDown {
            from { transform: translateY(-40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .main-grid { grid-template-columns: 1fr; }
            nav { width: 95%; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Foundly.</div>
        <div class="user-profile">
            <span>Halo, <strong><?php echo $nama_user; ?></strong> 👋</span>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1>Dashboard Mahasiswa</h1>
            <p>Pantau laporan barang hilangmu secara real-time.</p>
        </div>

        <div class="main-grid">
            <div class="card-action">
                <div style="font-size: 50px; margin-bottom: 20px;">📦</div>
                <h3>Kehilangan Barang?</h3>
                <p style="font-size: 14px; color: rgba(0,0,0,0.5); margin-top: 10px; line-height: 1.5;">Buat laporan agar petugas dapat membantu mencari barangmu segera.</p>
                <a href="tambah_laporan.php" class="btn-add">+ Buat Laporan</a>
            </div>

            <div class="history-section" style="width: 100%; grid-column: span 2;">
                <h2>History Laporan</h2>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th style="min-width: 200px;">Barang</th>
                                <th>Lokasi Terakhir</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_user = $_SESSION['id_user'];
                            $query = mysqli_query($conn, "SELECT * FROM laporan WHERE id_user='$id_user' ORDER BY id_laporan DESC");
                            
                            if(mysqli_num_rows($query) > 0) {
                                while($data = mysqli_fetch_assoc($query)) {
                                    $status_class = ($data['status'] == 'Ditemukan') ? 'status-found' : 'status-pending';
                                    ?>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <?php if(!empty($data['foto_barang'])): ?>
                                                    <img src="uploads/<?php echo $data['foto_barang']; ?>" class="item-thumb" style="margin: 0; flex-shrink: 0;">
                                                <?php endif; ?>
                                                <span style="white-space: nowrap;"><?php echo $data['nama_barang']; ?></span>
                                            </div>
                                        </td>
                                        <td><span style="display: block; min-width: 120px;"><?php echo $data['lokasi']; ?></span></td>
                                        <td style="color: rgba(0,0,0,0.4); white-space: nowrap;"><?php echo date('d M Y', strtotime($data['tgl_lapor'])); ?></td>
                                        <td style="font-weight: 700; font-size: 14px; white-space: nowrap;">
    <?php if($data['status'] == 'ditemukan'): ?>
        <span style="color: #2ecc71;">
            <span style="font-size: 10px; vertical-align: middle; margin-right: 6px;">●</span>Ditemukan
        </span>
    <?php else: ?>
        <span style="color: #f39c12;">
            <span style="font-size: 10px; vertical-align: middle; margin-right: 6px;">●</span>Belum Ditemukan
        </span>
    <?php endif; ?>
</td>
                                        <td>
                                            <div style="display: flex; gap: 10px;">
                                                <a href="edit_laporan.php?id=<?php echo $data['id_laporan']; ?>" class="btn-edit">Edit</a>
                                                <a href="hapus_laporan.php?id=<?php echo $data['id_laporan']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' style='text-align:center; padding: 60px; color:rgba(0,0,0,0.3);'>Belum ada riwayat laporan saat ini.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>