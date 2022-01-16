
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
  <div id="audio"></div>
<div class="wrapper">

<nav id="sidebar" class="position-fixed fixed-top fixed-bottom bg-dark">
          <div class="sidebar-header pt-5">
          <!-- <img src="../images/Toko.svg" alt="" width="60" height="60" class="d-inline-block align-bottom"> -->
              <h1 class="text-light" style="font-family: cursive;">Dashboard</h1> 
              <p class="text-info" style="font-family: cursive;font-size:medium;">Welcome to Dashboard</p> 
          </div>

          <ul class="list-unstyled components pl-2 pr-3 ">
              <p></p>
              <li id="activ-pembayaran" class="active mb-1">
              <!-- <img src="../images/makanan.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="index.php" data-toggle="collapse" aria-expanded="false" id="btn-pembayaran ">Dashboard</a>
              </li>


              <li id="activ-riwayat ">
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
  <p><a href="">Dashboard</a></p>
</div>
<div id="dashboard" class="d-flex flex-wrap justify-content-start">

   <div class="bg-dark m-3 p-5 d-flex flex-wrap flex-column" style="width: 30%;color:white" >
     
     <h1 id="h1">0</h1>
      <h5>Minuman terjual/Bulan ini</h5>
   </div>
   <div class="bg-success p-5 m-3 d-flex flex-wrap flex-column" style="width: 30%;color:white">
      <h1 id="h2">0</h1>
      <h5>Makanan terjual/Bulan ini</h5>
   </div>
   <div class="bg-info p-5 m-3 d-flex flex-wrap" style="width: 30%; color:white">
      <h1 id="h3">Rp0</h1>
      <h5>Pendapatan/Bulan ini</h5>
   </div>

</div>

<div>
  <p>riwayat transaksi</p>
</div>

<table class="table" id="tTransaksi">
  <thead class=" table-dark">
    <th>Tanggal</th>
    <th>No transaksi</th>
    <th>Nama pegawai</th>
    <th>total</th>
    <th>Action</th>
  </thead>
  <tbody class="table-light" id="tbody">
  <?php
    $data_transaksi = $data->ambildata_riwayat('transaksi','user');

    foreach($data_transaksi as $row){
    ?>
    
        <tr>
          <td><?=$row['tanggal']?></td>
          <td><?=$row['id_transaksi']?></td>
          <td><?=$row['nama']?></td>
          <td><?=$row['total']?></td>
          <td><button id="btn-detail" value="<?=$row['id_transaksi']?>" class="btn btn-warning" >detail</button></td>
        </tr>

    <?php
      }
    ?>
</tbody>
  </table>

</div>

</body>
  <script>
    $(Document).ready(function(){
      $.get("GetMinuman.php",function (data,status) {
        $('#h1').text(data);
      })
      $.get("GetMakanan.php",function (data,status) {
        $('#h2').text(data);
      })
      $.get("GetPendapatan.php",function (data,status) {
        $('#h3').text(data);
      })
    }) 
 
  </script>
  <script>
    $(Document).ready(function(){
       if (<?= $_GET['login']?> = "sukses") {
     $('#audio').append("<audio autoplay='true'><source src='../loginsukses.mp3' type='audio/mp3'></audio>");
      
      } 
    }) 
  </script>
</html>