<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['id_user']  = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['role']     = $data['role'];
    if ($data['role'] == "mahasiswa") {
        header("location:index.php");
    } else if ($data['role'] == "petugas") {
        header("location:index.php");
    }
} else {
    header("location:login.php?pesan=gagal");
}
?>