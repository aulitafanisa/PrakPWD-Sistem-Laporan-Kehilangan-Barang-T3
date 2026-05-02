<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    header("location:login.php");
    exit;
}
$role = $_SESSION['role'];
$nama_user = $_SESSION['nama'];
$id_user = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundly - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        body { 
            background-color: #f8f9fa; 
            color: #1a1a1a; 
            padding-bottom: 50px; 
        }
        nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 20px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .logo {
            font-weight: 800; 
            font-size: 20px; 
            letter-spacing: -1px; 
        }
        .user-info { 
            font-size: 14px; 
            font-weight: 600; 
        }
        .logout-btn { 
            color: #ff4757; 
            text-decoration: none; 
            margin-left: 15px; 
        }
        .container { 
            max-width: 1000px; 
            margin: 40px auto; 
            padding: 0 20px; 
        }
        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .welcome-card h1 { 
            font-size: 32px; 
            font-weight: 800; 
            margin-bottom: 10px; 
        }
        .welcome-card p { 
            color: #666; 
        }
        .btn-add {
            display: inline-block;
            background: #1a1a1a;
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
            margin-bottom: 30px;
        }
        .btn-add:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.1); 
        }
        .table-container {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th { 
            background: #fcfcfc; 
            padding: 20px; 
            text-align: left; 
            font-size: 13px; 
            font-weight: 700; 
            color: #888; 
            text-transform: uppercase;
             border-bottom: 1px solid #eee; 
            }
        td { 
            padding: 20px; 
            border-bottom: 1px solid #f5f5f5; 
            font-size: 14px; 
            vertical-align: middle; 
        }
        .status {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
        }
        .status-belum { 
            background: #fff4e5; 
            color: #ff9800; 
        }
        .status-ditemukan { 
            background: #e6fffa; 
            color: #38b2ac; 
        }
        .img-preview { 
            width: 60px; 
            height: 60px; 
            border-radius: 12px; 
            object-fit: cover; 
        }
        .action-link { 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 13px; 
            margin-right: 10px; 
        }
        .edit { 
            color: #4a6cf7; 
        }
        .delete { 
            color: #ff4757; 
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">LaporBarang.</div>
        <div class="user-info">
            <?php echo $nama_user; ?> | <span style="color: #888;"><?php echo ucfirst($role); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="welcome-card">
            <h1>Selamat datang, <?php echo $nama_user; ?>!</h1>
            <p><?php echo ($role == 'mahasiswa') ? 'Silakan laporkan barang yang hilang di kampus.' : 'Berikut adalah seluruh laporan kehilangan dari mahasiswa.'; ?></p>
        </div>
        <?php if ($role == 'mahasiswa'): ?>
            <a href="tambah_laporan.php" class="btn-add">+ Tambah Laporan</a>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM laporan WHERE id_user = '$id_user' ORDER BY tanggal DESC");
                        $no = 1;
                        while($d = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo $d['nama_barang']; ?></strong></td>
                            <td><?php echo $d['lokasi']; ?></td>
                            <td>
                                <span class="status <?php echo ($d['status'] == 'ditemukan') ? 'status-ditemukan' : 'status-belum'; ?>">
                                    <?php echo $d['status']; ?>
                                </span>
                            </td>
                            <td><?php echo date('d M Y', strtotime($d['tanggal'])); ?></td>
                            <td>
                                <a href="edit_laporan.php?id=<?php echo $d['id_laporan']; ?>" class="action-link edit">Edit</a>
                                <a href="hapus_laporan.php?id=<?php echo $d['id_laporan']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pelapor</th>
                            <th>Barang</th>
                            <th>Lokasi</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT laporan.*, users.nama FROM laporan JOIN users ON laporan.id_user = users.id_user ORDER BY tanggal DESC");
                        while($d = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?php echo $d['nama']; ?></td>
                            <td><strong><?php echo $d['nama_barang']; ?></strong></td>
                            <td><?php echo $d['lokasi']; ?></td>
                            <td>
                                <?php if($d['foto']): ?>
                                    <img src="uploads/<?php echo $d['foto']; ?>" class="img-preview">
                                <?php else: ?>
                                    <span style="color: #ccc;">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status <?php echo ($d['status'] == 'ditemukan') ? 'status-ditemukan' : 'status-belum'; ?>">
                                    <?php echo $d['status']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="update_status.php?id=<?php echo $d['id_laporan']; ?>" class="btn-add" style="padding: 8px 16px; font-size: 12px; margin-bottom:0;">Update</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
</body>
</html>