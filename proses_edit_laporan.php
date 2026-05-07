<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("location:login.php");
    exit();
}

$id_user     = $_SESSION['id_user'];
$id_laporan  = mysqli_real_escape_string($conn, $_POST['id_laporan']);
$nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
$lokasi      = mysqli_real_escape_string($conn, $_POST['lokasi']);
$deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);

$query = "UPDATE laporan SET 
          nama_barang = '$nama_barang', 
          lokasi = '$lokasi', 
          deskripsi = '$deskripsi' 
          WHERE id_laporan = '$id_laporan' AND id_user = '$id_user'";

if (mysqli_query($conn, $query)) {
    header("location:dashboard_mhs.php?pesan=update_berhasil");
} else {
    echo "Gagal memperbarui laporan: " . mysqli_error($conn);
}
?>