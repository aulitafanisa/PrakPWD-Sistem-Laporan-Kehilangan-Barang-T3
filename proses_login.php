<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$role     = mysqli_real_escape_string($conn, $_POST['role']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['id_user']  = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['role']     = $data['role'];

    if ($data['role'] == "mahasiswa") {
        header("location:dashboard_mhs.php");
    } else if ($data['role'] == "petugas") {
        header("location:dashboard_petugas.php");
    }
    exit();
} else {
    header("location:login.php?pesan=gagal");
}
?>