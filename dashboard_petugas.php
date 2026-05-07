<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
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
    <title>Petugas Dashboard — Foundly.</title>
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
            color: #000;
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
            margin: 20px auto;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            width: 90%;
            max-width: 1200px;
            top: 20px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            z-index: 1000;
        }

        .logo { font-weight: 800; font-size: 20px; letter-spacing: -1px; }

        .btn-logout {
            background: #000;
            color: #fff;
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

        .header-title {
            margin-bottom: 40px;
            animation: fadeIn 0.8s ease-out;
        }

        .header-title h1 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1.5px;
        }

        .header-title p {
            color: rgba(0,0,0,0.5);
            font-weight: 500;
        }

        .admin-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-radius: 40px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 40px 100px rgba(0,0,0,0.08);
            animation: cardUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
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
            vertical-align: middle;
        }

        .item-preview {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 12px;
            background: #eee;
        }

        .item-info {
            display: flex;
            align-items: center;
        }

        .status-select {
            padding: 10px 14px;
            border-radius: 15px;
            border: 1px solid rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.5);
            font-weight: 700;
            font-size: 13px;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .status-select:focus {
            background: #fff;
            border-color: #6366f1;
        }

        .btn-update {
            background: #6366f1;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-update:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .reporter-info {
            font-size: 12px;
            color: rgba(0,0,0,0.4);
            display: block;
            margin-top: 4px;
        }

        .desc-text {
            font-size: 13px;
            color: #444;
            max-width: 200px;
            line-height: 1.4;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .admin-card { padding: 20px; overflow-x: auto; }
            table { min-width: 800px; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Foundly. <span style="font-weight: 400; font-size: 14px; color: #6366f1; margin-left: 5px;">Petugas</span></div>
        <a href="logout.php" class="btn-logout">Logout</a>
    </nav>

    <div class="container">
        <div class="header-title">
            <h1>Manajemen Laporan</h1>
            <p>Update status barang mahasiswa secara real-time.</p>
        </div>

        <div class="admin-card">
            <table>
                <thead>
                    <tr>
                        <th>Barang & Pelapor</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT laporan.*, users.nama FROM laporan 
                                                 JOIN users ON laporan.id_user = users.id_user 
                                                 ORDER BY laporan.id_laporan DESC");
                    
                    while($data = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td>
                                <div class="item-info">
                                    <?php if(!empty($data['foto_barang'])): ?>
                                        <img src="uploads/<?php echo $data['foto_barang']; ?>" class="item-preview">
                                    <?php else: ?>
                                        <div class="item-preview" style="display: flex; align-items: center; justify-content: center; font-size: 10px; color: #ccc;">No Pic</div>
                                    <?php endif; ?>
                                    <div>
                                        <strong><?php echo $data['nama_barang']; ?></strong>
                                        <span class="reporter-info">Oleh: <?php echo $data['nama']; ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $data['lokasi']; ?></td>
                            <td class="desc-text"><?php echo $data['deskripsi']; ?></td>
                            <td><?php echo date('d M Y', strtotime($data['tgl_lapor'])); ?></td>
                            <form action="update_status.php" method="POST">
                                <input type="hidden" name="id_laporan" value="<?php echo $data['id_laporan']; ?>">
                                <td>
                                    <select name="status" class="status-select">
                                        <option value="belum ditemukan" <?php echo ($data['status'] == 'belum ditemukan') ? 'selected' : ''; ?>>belum ditemukan</option>
                                        <option value="ditemukan" <?php echo ($data['status'] == 'ditemukan') ? 'selected' : ''; ?>>ditemukan</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn-update">Update</button>
                                </td>
                            </form>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>