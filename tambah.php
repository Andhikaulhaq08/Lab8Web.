<?php
// Menampilkan semua error untuk debugging
error_reporting(E_ALL);

// Menghubungkan ke database
include_once 'koneksi.php';

// Proses saat tombol submit ditekan
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga_jual = mysqli_real_escape_string($conn, $_POST['harga_jual']);
    $harga_beli = mysqli_real_escape_string($conn, $_POST['harga_beli']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    // Menangani upload file
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']); // Menghindari spasi pada nama file
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        // Memindahkan file yang diunggah ke folder tujuan
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) 
            VALUES ('$nama', '$kategori', '$harga_jual', '$harga_beli', '$stok', '$gambar')";

    // Eksekusi query dan cek hasilnya
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php'); // Redirect ke halaman utama
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
