<?php 
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

require 'functions.php'; // menghubungkan / memanggil

// pagination
// konfigurasi
$jumlahDataPerhalaman = 5;
$jumlahData = count(query("SELECT * FROM barang_aksesoris"));
$jumlaHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;




$barang = query("SELECT * FROM barang_aksesoris ORDER BY id DESC LIMIT $awalData, $jumlahDataPerhalaman");

// tombol cari di klik
if(isset($_POST['cari'])){
    $barang = cari($_POST['keyword']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&family=Montserrat:wght@400;
    700&family=Noto+Sans:ital,wght@0,400;1,600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<style>

h1 {
  display: flex;
  justify-content: center;
  margin-bottom: -100px;
  font-family: "Montserrat", sans-serif;
}

main {
  display: flex;
  margin-top: 130px;
  margin-bottom: 100px;
}

.tabel {
  width: fit-content;
margin: 0 auto;
  font-family: "Poppins", sans-serif;
  border-collapse: collapse;
  
}

.tambah a {
  height: fit-content;
  position: fixed;
  right: 0;
  text-decoration: none;
  font-family: "Noto Sans", sans-serif;
  color: black;
  border: 1px solid black;
  background-color: lightgrey;
}

table tr:nth-child(1) {
  background-color: greenyellow;
}

table tr:nth-child(even){
    background-color: grey;
}

.logout {
    position: sticky;
    top: 100px;
}

form {
    position: fixed;
    top: 10px;
    left: 450px;
}

form input {
    padding: 7px;
    border-radius: 10px;
}

form button {
    padding: 7px;
    border-radius: 5px;
    cursor: pointer;
}

</style>
<body>
<a href="logout.php" class="logout">Log Out</a>

<h1>Daftar Barang</h1>

<main>
    <div class="tambah">
        <a href="tambah.php">Tambah data barang</a>
    </div>
    
    <form action="" method="POST" >
        <input type="text" name="keyword" size="50" autofocus placeholder="Masukkan keyword pencarian....." autocomplete="off">
        <button type="submit" name="cari">Cari</button>      
    </form>

    <!-- NAVIGASI -->

    <?php if($halamanAktif > 1) :  ?>
        <a href="?halaman=<?= $halamanAktif - 1; ?>">⟪</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlaHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold;color: red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if($halamanAktif < $jumlaHalaman) :  ?>
        <a href="?halaman=<?= $halamanAktif +1; ?>">⟫</a>
    <?php endif; ?>


    <div class="tabel">
        <table cellpadding="15" >

     
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
            <?php foreach( $barang as $row ) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('yakin?');">Hapus</a>
                    </td>
                    <td>
                        <img src="img/<?= $row["gambar"];?>" alt="" width="60"
                    </td>
                    <td><?= $row["nama_barang"]?></td>
                    <td><?= $row["rgb"]?></td>
                    <td><?= $row["dpi"]?></td>
                    <td><?= $row["konektor"]?></td>
                    <td>Rp <?= $row["harga"]?></td>
                </tr>
            <?php $i++; ?>
            <?php endforeach; ?>


        </table>
    </div>
</main>

</body>
</html>