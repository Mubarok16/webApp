<?php
    include('../config.php');
    $db = new database();

    $tgl_awal = date('m');
    $tahun = date('Y');

    $qry = mysqli_query($db->koneksi,"select sum(qty) as qty FROM detail_transaksi,menu,transaksi WHERE detail_transaksi.id_makanan = menu.id_makanan and menu.jenis_makanan='makanan' and detail_transaksi.id_transaksi=transaksi.id_transaksi and year(transaksi.tanggal) = '$tahun' and month(transaksi.tanggal) = '$tgl_awal' ");
    $ar = mysqli_fetch_array($qry);
    echo $ar['qty'];
    

?>