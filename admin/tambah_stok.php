
<?php
  session_start();
  include ('../config.php');
  $data = new database();


 
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

  <div>
  <p><a href="">Edit Menu makanan</a></p>
</div>


<div id="tambahStok" class="pb-5">
  

  <table class="table " id="table-makanan">
    <tr class="bg-dark" style="color: white;">
        <th>Nama makanan</th>
        <th>Jenis makanan</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Action</th>
    </tr>

  </table> 


</div>

<div id="tambah" class="pt-5">
  <div><p>Tambah Stok</p></div>
</div>

</div>

</body>
<script>
    $(Document).ready(function(){
      $.get("GetTabel.php",function (data,status) {
        $('#table-makanan').append(data);
      });

    })  
  </script>
</html>