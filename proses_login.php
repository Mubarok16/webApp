<?php

    include 'config.php';
    $db = new database();

    if(isset($_POST['btn'])){
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];

            $query = mysqli_query($db->koneksi,"SELECT * FROM user where username = '$username' AND password = '$password' ");

            $row = mysqli_num_rows($query);
            
                if ($row > 0 ) {
                    mysqli_query($db->koneksi, "update user set status = '1' where password = '$password' ");
                    $arr = mysqli_fetch_array($query);
                    if ($arr['level'] == 1) {
                        $_SESSION['username'] = $username;
                        header('location:admin/index.php?login=sukses');
                    }else{
                        $_SESSION['username'] = $username;
                        header('location:user/index.php?login=sukses');
                    }
                }else{
                    // header('location:index.php');
                }                
    }
?>