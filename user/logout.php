<?php
    $koneksi = mysqli_connect('localhost','root','','pemesanan_makanan');

    session_start();

    $username = $_SESSION['username'];
    $query = mysqli_query($koneksi,"UPDATE user SET status='0' where username= '$username' ");
    

    session_destroy();
    header('location:../index.php');
?>