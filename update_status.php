<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("location:login.php");
    exit();
}

$id_laporan = mysqli_real_escape_string($conn, $_POST['id_laporan']);
$status     = mysqli_real_escape_string($conn, $_POST['status']);

$query = "UPDATE laporan SET status = '$status' WHERE id_laporan = '$id_laporan'";

if (mysqli_query($conn, $query)) {
    header("location:dashboard_petugas.php?pesan=update_berhasil");
} else {
    echo "Gagal memperbarui status: " . mysqli_error($conn);
}
?>