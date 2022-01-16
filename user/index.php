
<?php
  
    include ('fungsi.php');
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

    <title>Halaman User</title>
</head>
<body>
<div id="audio"></div>
<div class="wrapper">

<nav id="sidebar" class="position-fixed fixed-top fixed-bottom bg-dark">
            <div class="sidebar-header pt-3">
            <!-- <img src="../images/Toko.svg" alt="" width="60" height="60" class="d-inline-block align-bottom"> -->
                <h1 class="text-light" style="font-family: cursive;">Restaurant</h1> 
                <p class="text-info" style="font-family: cursive;font-size:medium;">Welcome to restaurant</p> 
            </div>

            <ul class="list-unstyled components pl-2 pr-3 ">
                <p></p>
                <li id="activ-pembayaran" class="active mb-1">
                <!-- <img src="../images/makanan.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                    <a href="" data-toggle="collapse" aria-expanded="false" id="btn-pembayaran ">Menu makanan</a>
                </li>


                <li id="activ-riwayat ">
                <!-- <img src="../images/riwayat.svg" alt="" width="20" height="20" class="d-inline-block align-center">&nbsp;&nbsp;&nbsp;&nbsp -->
                    <a href="riwayat.php" data-toggle="collapse" aria-expanded="false" id="btn-riwayat">Riwayat transaksi</a>
                   
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

<div id="pembayaran" >
  <table class="table">
      <tr  class="table-success">
          <th>Pilih menu</th>
          <th>Jenis</th>
          <th>Harga / Porsi</th>
          <th>Jumlah</th>
          <th>Stok</th>
          <th>tanggal</th>
          <th></th>
      </tr>
    <form action="proses_pemesanan.php" method="post">
        
        <tr class="table-light">

            <td>
                <select id="menu" class="custom-select custom-sel " name="menu">
                    <option value="kosong">pilih menu</option>
                    <?php
                      $data->data_menu();
                    ?>
                </select>
            </td>
            <td id="jenis"></td>
            <td id="harga"></td>
            <td>
                <input type="text" name="jumlah" placeholder="jumlah" class="form-control">
            </td>
            <td id="stok"></td>
            <td>
                <label class="form-label"><?= date('Y-m-j'); ?></label>
            </td>
            <td>
                <button type="submit" value="tambah" class="btn btn-primary" name="btn-simpan">
                <img src="../images/addkeranjang.svg" alt="" width="25" height="25" class="d-inline-block align-top">
                </button>
            </td>

        </tr>
    </form>
  </table>   

    <table class="table table-light">
        <tr>
            <td id="gambar"></td>
            
        </tr>
    </table>

  <table class="table">
      <tr class="table-success">
          <th>Makanan</th>
          <th>Jumlah</th>
          <th>Tanggal</th>
          <th>Harga</th>
          <th>Action</th>
      </tr>
      

            <?php echo $data->tampil_detail_transaksi();



            
            ?>
        
  </table>
 </div>


</div>

</body>
    <script src="css/user.js"></script>
    <script>
    $(Document).ready(function(){
       if (<?= $_GET['login']?> = "sukses") {
     $('#audio').append("<audio autoplay='true'><source src='../loginsukses.mp3' type='audio/mp3'></audio>");
      
      } 
    }) 
  </script>
    <script type="text/javaScript">

$(Document).ready(function(){

  $("#menu").change(function() {
      var x = $("#menu").val();
      
      

       if (x == "Nasi Lengko") {

        <?php 
            $qry = mysqli_query($data->koneksi,"select * from menu where nama_makanan='Nasi Lengko' ");
            $arrmenu = mysqli_fetch_array($qry);
            $row = mysqli_num_rows($qry); 
        ?>

        var stok = "<?=$arrmenu['stok'];?>";
        var hargasatuan = "<?=$arrmenu['harga'];?>";
        var jenis = "<?=$arrmenu['jenis_makanan'];?>";
        $("#jenis").text(jenis);
        $("#harga").text(hargasatuan);
        $("#stok").text(stok);

        $("#gambar").append("<img src='../images/images.jpeg' width='150' height='100' id='Glengko' class='img'>");
        $("#Gpindang").remove();
        $("#Gesteh").remove();
        $("#Gkucing").remove();
        $("#Gmangga").remove();
       }else if(x == "Pindang Gombyang"){

        <?php 
            $qry = mysqli_query($data->koneksi,"select * from menu where nama_makanan='Pindang Gombyang' ");
            $arrmenu = mysqli_fetch_array($qry);
            $row = mysqli_num_rows($qry); 
        ?>

        var stok = "<?=$arrmenu['stok'];?>";
        var hargasatuan = "<?=$arrmenu['harga'];?>";
        var jenis = "<?=$arrmenu['jenis_makanan'];?>";

        $("#jenis").text(jenis);
        $("#harga").text(hargasatuan);
        $("#stok").text(stok);
        
      
        $("#gambar").append("<img src='../images/pindang.jpeg' width='150' height='100' id='Gpindang' class='img'>");
        $("#Gesteh").remove();
        $("#Glengko").remove();
        $("#Gkucing").remove();
        $("#Gmangga").remove();
       }else if(x == "Nasi Kucing"){

        <?php 
            $qry = mysqli_query($data->koneksi,"select * from menu where nama_makanan='Nasi Kucing' ");
            $arrmenu = mysqli_fetch_array($qry);
            $row = mysqli_num_rows($qry); 
        ?>

        var stok = "<?=$arrmenu['stok'];?>";
        var hargasatuan = "<?=$arrmenu['harga'];?>";
        var jenis = "<?=$arrmenu['jenis_makanan'];?>";
        $("#jenis").text(jenis);
        $("#harga").text(hargasatuan);
        $("#stok").text(stok);

        $("#gambar").append("<img src='../images/nasi kucing.jpeg' width='150' height='100' id='Gkucing' class='img'>");
        $("#Gpindang").remove();
        $("#Glengko").remove();
        $("#Gesteh").remove();
        $("#Gmangga").remove();
       }else if (x == "Jus Mangga") {

        <?php 
            $qry = mysqli_query($data->koneksi,"select * from menu where nama_makanan='Jus Mangga' ");
            $arrmenu = mysqli_fetch_array($qry);
            $row = mysqli_num_rows($qry); 
        ?>

        var stok = "<?=$arrmenu['stok'];?>";
        var hargasatuan = "<?=$arrmenu['harga'];?>";
        var jenis = "<?=$arrmenu['jenis_makanan'];?>";
        $("#jenis").text(jenis);
        $("#harga").text(hargasatuan);
        $("#stok").text(stok);

        $("#gambar").append("<img src='../images/jusmangga.jpeg' width='150' height='100' id='Gmangga' class='img'>");
        $("#Gpindang").remove();
        $("#Gpindang").remove();
        $("#Glengko").remove();
        $("#Gkucing").remove();
        $("#Gesteh").remove();
       }else if(x == "Es Teh"){

        <?php 
            $qry = mysqli_query($data->koneksi,"select * from menu where nama_makanan='Es Teh' ");
            $arrmenu = mysqli_fetch_array($qry);
            $row = mysqli_num_rows($qry); 
        ?>

        var stok = "<?=$arrmenu['stok'];?>";
        var hargasatuan = "<?=$arrmenu['harga'];?>";
        var jenis = "<?=$arrmenu['jenis_makanan'];?>";
        $("#jenis").text(jenis);
        $("#harga").text(hargasatuan);
        $("#stok").text(stok);

        $("#gambar").append("<img src='../images/esteh.jpeg' width='150' height='100' id='Gesteh' class='img'>");
        $("#Gpindang").remove();
        $("#Glengko").remove();
        $("#Gkucing").remove();
        $("#Gmangga").remove();
       }else{
        $("#jenis").text("");
        $("#harga").text("");
        $("#stok").text(""); 
        $("img.img").remove();   
       }
  });

});


 
    </script>
</html>