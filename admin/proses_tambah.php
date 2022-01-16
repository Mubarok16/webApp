
<?php
  session_start();
  include ('../config.php');
  $data = new database();

    $id = $_GET['id'];
    $qrymenu = mysqli_query($data->koneksi,"select * from menu where id_makanan = '$id' ");
    $armenu = mysqli_fetch_array($qrymenu);
    if (isset($_POST['btn-tambah'])) {
        $stok = $_POST['stok'];
        $nama=$_POST['nama_makanan'];
        $harga = $_POST['harga'];

        $qryupdate = mysqli_query($data->koneksi,"update menu set stok='$stok',nama_makanan='$nama',harga='$harga' where id_makanan = '$id' ");
        header('location:tambah_stok.php');
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="../css/owl.carousel.min.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- Style -->
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="css/style.css">

<script src="../js/jquery-3.3.1.min.js" type="text/javaScript"></script>

  <title>Halaman User</title>
</head>
<body>

<div class="wrapper">

<nav id="sidebar" class="position-fixed fixed-top fixed-bottom bg-dark">
          <div class="sidebar-header pt-5">
          <!-- <img src="../images/Toko.svg" alt="" width="60" height="60" class="d-inline-block align-bottom"> -->
              <h1 class="text-light" style="font-family: cursive;">Dashboard</h1> 
              <p class="text-info" style="font-family: cursive;font-size:medium;">Welcome to Dashboard</p> 
          </div>

          <ul class="list-unstyled components pl-2 pr-3 ">
              <p></p>
              <li id="activ-pembayaran" class="mb-1">
              <!-- <img src="../images/makanan.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="index.php" data-toggle="collapse" aria-expanded="false" id="btn-pembayaran ">Dashboard</a>
              </li>


              <li id="activ-Tambah "  class="active">
              <!-- <img src="../images/riwayat.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="tambah_stok.php" data-toggle="collapse" aria-expanded="false" id="btn-riwayat">Edit menu makanan</a>
                 
              </li>

              <li id="activ-riwayat ">
              <!-- <img src="../images/riwayat.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="riwayat.php" data-toggle="collapse" aria-expanded="false" id="btn-riwayat">riwayat pemesanan</a>
                 
              </li>
          </ul>

          <button type="submit" class="btn btn-danger col-md-10 ml-3"><a href="logout.php">Logout</a></button>
</nav>

<nav id="sidebar"></nav>

<div id="content">

    <nav class="navbar">
      <a href="" class="navbar-brand">
          <img src="../images/akun.svg" alt="" width="30" height="30" class="d-inline-block align-top">
          <?php 
              $username = $_SESSION['username']; 
              $nama = $data->getId('user','username',$username,'nama');
              echo $nama;
          ?>
      </a>
    </nav>

<div id="tambah" class="pt-5" >
  <div><p>edit menu </p></div>

  <form action="" method="post">
        
        <input type="text" name="nama_makanan" class="form-control" value="<?= $armenu['nama_makanan'] ?>" >
        <br>
        <input type="text" name="stok" class="form-control" value="<?=$armenu['stok']?>">
        <br>
        <input type="text" name="harga" class="form-control" value="<?=$armenu['harga']?>">
        <br>
        <input type="submit" value="ubah" class="btn btn-primary" name="btn-tambah">

  </form>

</div>

</div>

</body>
<script>
    $(Document).ready(function(){
 

    })  
  </script>
</html>