<?php
    include('../config.php');
    $db = new database();

    $data = $_POST['dicari'];

    $qry = mysqli_query($db->koneksi,"SELECT transaksi.*,detail_transaksi.*,menu.* from transaksi,detail_transaksi,menu where menu.nama_makanan = '$data' and transaksi.id_transaksi = detail_transaksi.id_transaksi and detail_transaksi.id_makanan = menu.id_makanan  order by transaksi.id_transaksi DESC");

if (mysqli_fetch_row($qry) == 0) {
    echo "<tr><td></td><td></td><td>TIDAK ADA DATA</td><td></td><td></td></tr>";
}else{
   
    while($ar = mysqli_fetch_array($qry)){
echo"

    <tr>
      <td>".$ar['tanggal']."</td>
      <td>".$ar['id_transaksi']."</td>
      <td>".$ar['nama_makanan']."</td>
      <td>".$ar['qty']."</td>
      <td>".$ar['sub_total']."</td>
    </tr>
";
   

  }
}
    
?>