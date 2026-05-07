<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("location:login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_laporan = mysqli_real_escape_string($conn, $_GET['id']);
    $id_user = $_SESSION['id_user'];

    $sql_foto = mysqli_query($conn, "SELECT foto_barang FROM laporan WHERE id_laporan = '$id_laporan' AND id_user = '$id_user'");
    $data_foto = mysqli_fetch_assoc($sql_foto);

    if ($data_foto) {
        if (!empty($data_foto['foto_barang']) && file_exists("uploads/" . $data_foto['foto_barang'])) {
            unlink("uploads/" . $data_foto['foto_barang']);
        }

        $query = "DELETE FROM laporan WHERE id_laporan = '$id_laporan' AND id_user = '$id_user'";
        
        if (mysqli_query($conn, $query)) {
            header("location:dashboard_mhs.php?pesan=hapus_berhasil");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        header("location:dashboard_mhs.php");
    }
} else {
    header("location:dashboard_mhs.php");
}
?>