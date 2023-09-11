<?php 
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// ambil data dari tabel barang aksesoris / query data barang aksesoris
$result = mysqli_query($koneksi, "SELECT * FROM `barang aksesoris`" );

// ambil data (fetch) barang aksesoris dari object result
// mysqli_fetch_row() // mengembalikan nilai array numeric
// mysqli_fetch_assoc() // mengembalikan nilai array associative
// mysqli_fetch_array() // mengembalikan array numeric dan associative
// mysqli_fetch_object() // 


/* while($brg = mysqli_fetch_assoc($result)) {

var_dump($brg);
}
*/


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<h1>Daftar Barang</h1>
<table border="1" cellpadding="10" cellspascing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nama Barang</th>
        <th>RGB</th>
        <th>DPI</th>
        <th>Konektor</th>
        <th>Harga</th>
    </tr>

    <?php $i = 1; ?>
    <?php while($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="">Ubah</a> |
            <a href="">Hapus</a>
        </td>
        <td>
            <img src="img/<?= $row["gambar"]?>" alt="" width="60"
        </td>
        <td><?= $row["nama barang"]?></td>
        <td>YES</td>
        <td>3000</td>
        <td>Wireless</td>
        <td>Rp 500.000</td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>

</table>

</body>
</html>