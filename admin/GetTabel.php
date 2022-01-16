<?php
    include('../config.php');
    $db = new database();

    $tgl_awal = date('m');


    $qry = mysqli_query($db->koneksi,"select * from menu");
    while($ar = mysqli_fetch_array($qry)){
echo"
   <tr class='bg-light'>
      <td>".$ar['nama_makanan']."</td>
      <td>".$ar['jenis_makanan']."</td>
      <td>".$ar['stok']."</td>
      <td>".$ar['harga']."</td>
      <td><button class='btn btn-success' id='btn-add' name='btn-add'><a href='proses_tambah.php?id=".$ar['id_makanan']."&&btn="."btn-add"." '>edit menu</a></button></td>
    </tr>
";
    }
?>