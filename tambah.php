<?php 
// cek login
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}


require 'functions.php';
// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST['submit'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0 ){
        echo "<script>
                alert('Data Berhasil ditambahkan');
                document.location.href = 'index.php'
            </script>";
    }else {
            echo "<script>
                alert('Data GAGAL ditambahkan');
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
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" href="style/styleTambah.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&family=Montserrat:wght@400;
    700&family=Noto+Sans:ital,wght@0,400;1,600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Data Barang</h1>
        </header>

        <main>
            <form action="" method="post" enctype="multipart/form-data"> // enctype untuk mengelola file
                <ul>
                    <li>
                        <label for="nama barang">Nama barang</label>
                        <input type="text" name="nama_barang" id="nama barang" required>
                    </li>

                    <li>
                        <label for="rgb">RGB</label>
                        <input type="text" name="rgb" id="rgb" placeholder="YES / NO" required>
                    </li>

                    <li>
                        <label for="dpi">Berapa DPI</label>
                        <input type="number" name="dpi" id="dpi" required>
                    </li>

                    <li>
                        <label for="konektor">Jenis konektor</label>
                        <input type="text" name="konektor" id="konektor"  required>
                    </li>

                    <li>
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" required>
                    </li>

                    <li>
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" id="gambar" required>
                    </li>

                    <li>
                        <button type="submit" name="submit">KIRIM DATA!</button>
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