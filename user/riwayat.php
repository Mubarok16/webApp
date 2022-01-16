<?php
include('fungsi.php');

     $data = new datapesanan();

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
<script src="js/print.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="wrapper">
                <?php $username = $_SESSION['username']; 
                    $nama = $data->getId('user','username',$username,'nama');
                ?>

<nav id="sidebar" class="position-fixed fixed-top fixed-bottom bg-dark">
            <div class="sidebar-header pt-3">
            <!-- <img src="../images/Toko.svg" alt="" width="60" height="60" class="d-inline-block align-bottom"> -->
                <h1 class="text-light" style="font-family: cursive;">Restaurant</h1> 
                <p class="text-info" style="font-family: cursive;font-size:medium;">Welcome to restaurant</p> 
            </div>

            <ul class="list-unstyled components pl-2 pr-3 ">
                <p></p>
                <li id="activ-pembayaran" class="mb-1">
                <!-- <img src="../images/makanan.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                    <a href="index.php" data-toggle="collapse" aria-expanded="false" id="btn-pembayaran ">Menu makanan</a>
                </li>


                <li id="activ-riwayat" class="active">
                <!-- <img src="../images/riwayat.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                    <a href="" data-toggle="collapse" aria-expanded="false" id="btn-riwayat">Riwayat transaksi</a>
                   
                </li>
    
            </ul>

            <button type="submit" class="btn btn-danger col-md-10 ml-3"><a href="logout.php">Logout</a></button>
</nav>

<nav id="sidebar"></nav>

<div id="content">
    <nav class="navbar navbar-success">
        <a href="" class="navbar-brand">
            <img src="../images/akun.svg" alt="" width="30" height="30" class="d-inline-block align-top">
            <?php 
                $username = $_SESSION['username']; 

                $nama = $data->getId('user','username',$username,'nama');
                echo $nama;
                $id = $data->getId('user','username',$username,'id_user'); 
            ?>
        </a>
       
    </nav>

    <div id="riwayat">
        <table class="table table-light">
         <tr>
         <?php
            $tarray = array('No transaksi','Tanggal');
         ?>
            <th><?=$tarray[0]?></th>
            <th><?=$tarray[1]?></th>
            <th>nama pegawai</th>
            <th>total</th>
            <th>Action</th>
         </tr>
            
            
                    <?php
                // select transaksi.*,user.* from transaksi,user where user.id_user = '$id' and transaksi.id_user = '$id' order by id_transaksi desc

                $qryriwayat = mysqli_query($data->koneksi,"SELECT * FROM transaksi INNER JOIN user ON user.id_user = '$id' AND transaksi.id_user = user.id_user order by id_transaksi desc");
            
                
                while($arriwayat = mysqli_fetch_array($qryriwayat)) { 
                  
          
                   
                
            ?>
        <form action="print.php" method="post">
        <input type="text" name="id" value="<?=$id?>" class="hide">
        <input type="text" name="no" value="<?=$arriwayat['id_transaksi']?>" class="hide">
          <tr>
              <td><?= $arriwayat['id_transaksi'] ?></td>
              <td><?= $arriwayat['tanggal'] ?></td>
              <td><?= $arriwayat['nama'] ?></td>
              <td><?= $arriwayat['total'] ?></td>
              <td><button class="btn btn-success">Cetak Struk</button></td>

          </tr>
        </form>
          <?php
                }
            
          ?>
        </table>
    </div>

</div>


</div>

</body>
</html>