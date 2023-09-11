<?php 
session_start();
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($koneksi, "SELECT username FROM users 
            WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] == true;
    }
}

if(isset($_SESSION['login'])){
    header("Location: index.php"); 
}


if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE
                username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1){

        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            // set session
            $_SESSION['login'] = true;

            if(isset($_POST['remember'])){
                // membuat cookie
                
                setcookie('id',$row['id'],time()+120);
                setcookie('key',hash('sha256', $row['username']), time()+60);
            }

            header("Location: index.php");
            exit;
        }

    }
    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<style>
    span {
        position: absolute;
        top: 0;
        left: 600px;
        color: red;
    }

    .container {
        width: fit-content;
        margin: 100px auto;
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        width: 320px;
        height: 350px;
        background-color: #111827;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
    }

    h1 {
        display: flex;
        justify-content: center;
        color: white;
    }

    ul {
        display: flex;
        flex-direction: column;
        justify-content: center ;
    }

    ul li {
        list-style: none;
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
        color: grey;
    }

    li input {
        width: 238px;
        padding: 5px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #a78bfa;
    }

    li input:focus {
        outline: none;
        background-color: #ddd;
    }

    li:nth-child(2) input {
        margin-bottom: 30px;
    }

    li:nth-child(3){
        width: 236px;
        margin-top: -15px;
        margin-bottom: 30px;
    }

     li:nth-child(3) label{
        width: fit-content;
        margin-top: -20px;
    }

    li:nth-child(3) input {
        cursor: pointer;
        accent-color: #a78bfa;
    }


    button {
        width: 238px;
        padding: 5px;
        background-color: #a78bfa;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: rgb(194, 163, 253);
    }
</style>
<body>
<div class="container">
    <?php if(isset($error)) : ?>
        <span>Username atau Password salah!</span>
    <?php endif; ?>




    <form action="" method="post">
    <h1>Login</h1>

        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required autocomplete="off">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Sign in</button>
            </li>
        </ul>

    </form>
</div>    
</body>
</html>