<?php
    include('../config.php');
    $db = new database();

    $tgl_awal = date('m');
    $tahun=date('Y');

    $qry = mysqli_query($db->koneksi,"select sum(total) as qty FROM transaksi where month(tanggal)='$tgl_awal' and year(transaksi.tanggal)='$tahun' ");
    $ar = mysqli_fetch_array($qry);
    echo "Rp".$ar['qty'];
    

?>