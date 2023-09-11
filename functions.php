<?php 

// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// query untuk menampilkan data
function query ($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}

// add
function tambah($data){
    global $koneksi;
    // ambil data dari tiap elemen form
    $nama_barang = $data['nama_barang'];
    $rgb = htmlspecialchars($data['rgb']);
    $dpi = htmlspecialchars($data['dpi']);
    $konektor = htmlspecialchars($data['konektor']);
    $harga = htmlspecialchars($data['harga']);

    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "INSERT INTO barang_aksesoris (nama_barang, rgb, dpi, konektor, harga, gambar) 
                VALUES
                ('$nama_barang', '$rgb', '$dpi', '$konektor', 
                    '$harga', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// upload
function upload(){
    $nameFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4){
        // error 4 ketika tidak ada file yang diupload
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";

            // untuk memberhentikan function
            return false;
    }

    // cek type file gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $nameFile); // memecah nama gambar dgn type
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // mengambil nama type file dgn yang paling akhir dan str agar huruf kecil
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                alert('pilih file gambar!!!');
            </script>";
    } # output boolean

    // cek ukuran jika terlalu besar
    if($sizeFile > 1000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!!!');
            </script>";
    }

    // lolos pengecekan gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' .  $namaFileBaru);

    // untuk variabel isi gambar
    return $namaFileBaru;
}

// delete
function hapus($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM barang_aksesoris WHERE id= $id");

    return mysqli_affected_rows($koneksi);
}

// ubah
function ubah($data){
    global $koneksi;
   
    // ambil data dari tiap elemen form
    $id = $data['id'];
    $nama_barang = $data['nama_barang'];
    $rgb = htmlspecialchars($data['rgb']);
    $dpi = htmlspecialchars($data['dpi']);
    $konektor = htmlspecialchars($data['konektor']);
    $harga = htmlspecialchars($data['harga']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else {
    $gambar = upload();
    }

    // htmlspecialchars agar tidak mudah di rubah oleh user

        // query insert date 
    $query = "UPDATE barang_aksesoris SET nama_barang = '$nama_barang', 
                                            rgb = '$rgb', 
                                            dpi = $dpi, 
                                            konektor = '$konektor', 
                                            harga = $harga, 
                                            gambar = '$gambar' WHERE id = $id" ;

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// search
function cari($keyword){
    $query = "SELECT * FROM barang_aksesoris
                WHERE
                nama_barang LIKE '%$keyword%' OR
                rgb LIKE '%$keyword%' OR
                konektor LIKE '%$keyword%' OR
                harga LIKE '%$keyword%' 
                #LIKE dan tambah % agar pencarian flexibel
            ";
    return query($query);
}

// login register
function register($data){
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);

    // ccek username sudah ada atau belum
   $result =  mysqli_query($koneksi, "SELECT username FROM users 
                WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    // enkripsi password
    $password =  password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke databe
    mysqli_query($koneksi, "INSERT INTO users (username, password) 
                VALUES
                ('$username','$password')");

    // untuk menghasilkan angka 1 untuk berhasil 
    return mysqli_affected_rows($koneksi);
}

?>