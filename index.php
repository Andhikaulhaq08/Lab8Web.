<?php
include("koneksi.php"); // Memastikan file koneksi.php tersedia dan tidak ada kesalahan

// Query untuk menampilkan data
$sql = 'SELECT * FROM data_barang'; 
$result = mysqli_query($conn, $sql); 

// Cek jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
</head>
<body>
    <div class="container">
        <h1>Data Barang</h1>
        <div class="main">
            <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                <?php if(mysqli_num_rows($result) > 0): ?> <!-- Pastikan ada data -->
                    <?php while($row = mysqli_fetch_assoc($result)): ?> <!-- Menggunakan fetch_assoc lebih disarankan -->
                        <tr>
                            <td><img src="gambar/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>" width="100"></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                            <td><?= htmlspecialchars($row['harga_jual']); ?></td>
                            <td><?= htmlspecialchars($row['harga_beli']); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>
                            <td><a href="edit.php?id=<?= htmlspecialchars($row['id_barang']); ?>">Edit</a> | <a href="delete.php?id=<?= htmlspecialchars($row['id_barang']); ?>">Hapus</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
