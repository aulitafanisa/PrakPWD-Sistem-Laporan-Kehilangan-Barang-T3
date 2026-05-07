<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header("location:login.php");
    exit();
}

$id_user      = $_SESSION['id_user'];
$nama_barang  = mysqli_real_escape_string($conn, $_POST['nama_barang']);
$lokasi       = mysqli_real_escape_string($conn, $_POST['lokasi']);
$deskripsi    = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$tgl_lapor    = date('Y-m-d');
$status       = "Pending";

$nama_file = "";
if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == 0) {
    $target_dir  = "uploads/";
    $file_ext    = pathinfo($_FILES["foto_barang"]["name"], PATHINFO_EXTENSION);
    $nama_file   = time() . "_" . $id_user . "." . $file_ext;
    $target_file = $target_dir . $nama_file;

    if (!move_uploaded_file($_FILES["foto_barang"]["tmp_name"], $target_file)) {
        $nama_file = "";
    }
}

$query = "INSERT INTO laporan (id_user, nama_barang, lokasi, deskripsi, tgl_lapor, status, foto_barang) 
          VALUES ('$id_user', '$nama_barang', '$lokasi', '$deskripsi', '$tgl_lapor', '$status', '$nama_file')";

if (mysqli_query($conn, $query)) {
    header("location:dashboard_mhs.php?pesan=berhasil_lapor");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>