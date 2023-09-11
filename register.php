<?php 
require 'functions.php';

if(isset($_POST['register'])){
    if(register($_POST) > 0 ){
        echo "<script>
                alert('user baru ditambahkan');
            </script>";
    }else {
        echo mysqli_error($koneksi);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>
<style>
    .container {
        width: fit-content;
        margin: 100px auto;
        font-family: Arial, Helvetica, sans-serif;
    }

    li {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    li input, button {
        width: 200px;
    }

    button {
        margin-left: 4px;
        cursor: pointer;
        border: 1px solid grey;
        transition: all .3s;
    }

    button:hover {
        background-color: grey;
        color: white;
        border: 1px solid grey;
        border-radius: 5px;
    }

</style>
<body>
    <div class="container">
        <h1>Halaman Registrasi</h1>

    <form action="" method="post">
       <ul>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="password2">Konfirmasi Password:</label>
            <input type="password" name="password2" id="password2" required>
        </li>
        <li>
            <button type="submit" name="register">Register!</button>
        </li>
       </ul>
    </form>
    </div>
</body>
</html>