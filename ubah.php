<?php
error_reporting(E_ALL);
include_once 'koneksi.php'; // Pastikan file koneksi.php ada di direktori yang benar

// Proses update data barang
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    // Jika ada file gambar diunggah
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    // Query untuk update data barang
    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar)) {
        $sql .= ", gambar = '{$gambar}' ";
    }
    $sql .= "WHERE id_barang = '{$id}'";

    // Eksekusi query
    $result = mysqli_query($conn, $sql);

    // Cek apakah query berhasil
    if ($result) {
        header('location: index.php'); // Redirect ke halaman utama
        exit();
    } else {
        die('Error: ' . mysqli_error($conn));
    }
}

// Mendapatkan data barang berdasarkan id
$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');

// Ambil data dari hasil query
$data = mysqli_fetch_array($result);

// Fungsi untuk menandai opsi select yang sesuai
function is_select($var, $val) {
    return $var == $val ? 'selected="selected"' : '';
}
?>
