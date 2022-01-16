
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
              <li id="activ-pembayaran" class=" mb-1">
              <!-- <img src="../images/makanan.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="index.php" data-toggle="collapse" aria-expanded="false" id="btn-pembayaran ">Dashboard</a>
              </li>


              <li id="activ-Tambah ">
              <!-- <img src="../images/riwayat.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                  <a href="tambah_stok.php" data-toggle="collapse" aria-expanded="false" id="btn-riwayat">Edit menu makanan</a>
                 
              </li>

              <li id="activ-riwayat" class="active">
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

              $qry = mysqli_query($data->koneksi,"select * from transaksi");
              
          ?>
      </a>
<div class="d-flex flex-inline">

    <select name="filter" id="filter">
    <option value="">Sortir by no transaksi</option>
    <?php while ($arop = mysqli_fetch_array($qry)) {
     ?>
        <option value="<?=$arop['id_transaksi']?>"><?=$arop['id_transaksi']?></option>
    <?php
    }
    ?>
    </select>
    
    <input type="text" class="form-control ml-2 mr-4" placeholder="Cari nama makanan ....." id="cari">     
</div>
    </nav>
<div>
<audio src="tarik.mp3" controls></audio>
</div>
<div><p>Riwayat</p></div>

<div id="Riwayat" >

<table class="table" id="tabel-cari" >
  <thead class="table-dark">
    <th>tanggal</th>
    <th>no transaksi</th>
    <th>nama makanan</th>
    <th>jumlah</th>
    <th>harga</th>
  </thead>

  <tbody class="table-light" id="tDetail">
  <?php
    $det = $data->data_detail('transaksi','detail_transaksi','menu');

  foreach ($det as $row) 
  {
    ?>
    <tr>
      <td><?=$row['tanggal']?></td>
      <td><?=$row['id_transaksi']?></td>
      <td><?=$row['nama_makanan']?></td>
      <td><?=$row['qty']?></td>
      <td><?=$row['sub_total']?></td>
    </tr>
    <?php

  }

    ?>
  </tbody>



</table>
 




</div>


</div>

</body>
      <script>
        $(document).ready(function(){

          $('#cari').keyup(function () {
            var dicari = $('#cari').val();
            $('#tDetail tr').remove();

            //ambil data dari file Cari.php dengan ajax

            $.ajax({
              url:'http://localhost/pemesanan_makanan/admin/Cari.php',
              data:{
                dicari : dicari
              },
              type:'json',
              method:'post',
              success:function(result){
                  $('#tDetail').html(result);
              }
            })
            
          })

          $('#filter').change(function () {
            var dicari = $('#filter').val();
            $('#tDetail tr').remove();

            //ambil data dari file Cari.php dengan ajax

            $.ajax({
              url:'http://localhost/pemesanan_makanan/admin/filter.php',
              data:{
                dicari : dicari
              },
              type:'json',
              method:'post',
              success:function(result){
                  $('#tDetail').html(result);
              }
            })
          })
        })
      </script>
</html>