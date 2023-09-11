<?php 
// cek login
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}


require 'functions.php';

// ambil data di url
$id = $_GET['id'];
// query data berdasarkan id
$brg = query("SELECT * FROM barang_aksesoris WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST['submit'])) {
    // cek apakah data berhasil diubah atau tidak
    if(ubah($_POST) > 0 ){
        echo "<script>
                alert('Data Berhasil diubah');
                document.location.href = 'index.php'
            </script>";
    }else {
            echo "<script>
                alert('Data GAGAL diubah');
                document.location.href = 'index.php'
            </script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>
    <link rel="stylesheet" href="style/styleTambah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&family=Montserrat:wght@400;
    700&family=Noto+Sans:ital,wght@0,400;1,600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Ubah Data Barang</h1>
        </header>

        <main>
            <form action="" method="post" enctype="multipart/form-data"> 
            <input type="hidden" name="id" value="<?= $brg['id']?>">
            <input type="hidden" name="gambarLama" value="<?= $brg['gambar']?>">
                <ul>
                    <li>
                        <label for="nama barang">Nama barang</label>
                        <input type="text" name="nama_barang" id="nama barang" required value="<?= $brg['nama_barang'];?>">
                    </li>

                    <li>
                        <label for="rgb">RGB</label>
                        <input type="text" name="rgb" id="rgb" placeholder="YES / NO" required value="<?= $brg['rgb'];?>">
                    </li>

                    <li>
                        <label for="dpi">Berapa DPI</label>
                        <input type="number" name="dpi" id="dpi" required value="<?= $brg['dpi'];?>">
                    </li>

                    <li>
                        <label for="konektor">Jenis konektor</label>
                        <input type="text" name="konektor" id="konektor"  required value="<?= $brg['konektor'];?>">
                    </li>

                    <li>
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" required value="<?= $brg['harga'];?>">
                    </li>

                    <li>
                        <label for="gambar">Gambar</label>
                        <img src="img/<?= $brg['gambar'];?>" alt="" width="40"> <br>
                        <input type="file" name="gambar" id="gambar">
                    </li>

                    <li>
                        <button type="submit" name="submit">UBAH DATA!</button>
                    </li>
                </ul>
            </form>
        </main>
        <div class="btn-back">
            <a href="index.php">Kembali</a>
        </div>
    </div>
</body>
</html>