<?php
include('../koneksi.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Validasi ID
if (!isset($_GET['id_gallery']) || !is_numeric($_GET['id_gallery'])) {
    echo "<script>alert('ID tidak valid.'); history.back();</script>";
    exit;
}

$id = intval($_GET['id_gallery']);

// Ambil nama file gambar
$sql = "SELECT foto FROM tbl_gallery WHERE id_gallery = $id LIMIT 1";
$query = mysqli_query($db, $sql);

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<script>alert('Data tidak ditemukan.'); history.back();</script>";
    exit;
}

$data = mysqli_fetch_assoc($query);
$foto = $data['foto'];

// Hapus file gambar jika ada
$filepath = "../images/" . basename($foto); // basename mencegah path traversal

if (file_exists($filepath)) {
    unlink($filepath);
}

// Hapus data dari database
$sql_delete = "DELETE FROM tbl_gallery WHERE id_gallery = $id LIMIT 1";
$query_delete = mysqli_query($db, $sql_delete);

if ($query_delete) {
    echo "<script>alert('Data gallery berhasil dihapus.'); window.location='data_gallery.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); history.back();</script>";
}
