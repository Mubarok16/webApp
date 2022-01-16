<?php
    include ('koneksi.php');
    $db = new database();

    if (isset($_POST['submit'])) {
        $db->cek_password($_POST['username'],$_POST['password']);
    }