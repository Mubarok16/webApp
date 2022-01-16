<?php
    include('fungsi.php');
    $datapesanan = new datapesanan();

if (isset($_POST['btn-simpan'])) {
    $datapesanan->simpan_data();
}

if (isset($_POST['btn-bayar'])) {
    $datapesanan->bayar();
}

//ambil action
$action = $_GET['action'];
//jika action == string delete maka program di jalankan
if ($action == "delete") {
    //get id makanan
    $id_makanan = $_GET['id'];
    //get id transaksi yang paling terakhir dari table detail transaksi 
    $qry = mysqli_query($datapesanan->koneksi,"select * from detail_transaksi order by id_transaksi desc");
    $ar = mysqli_fetch_array($qry);
    //isi id transaksi dari detail transaksi
    $id = $ar['id_transaksi'];
    //delete baris di detail transaksi selama id makanan = $id_makanan dan id transaksi = var id ;
    $qry_hapus = mysqli_query($datapesanan->koneksi,"delete from detail_transaksi where id_makanan='$id_makanan' AND id_transaksi = '$id' ");

    //untuk menambah stok karna sesuai jumlahnya karna stok di triger 
    //agar jumlah stoknya kembali seperti sebelumnya karena tidak jadi di beli
    $qrymenu = mysqli_query($datapesanan->koneksi,"select * from menu where id_makanan ='$id_makanan'");
    $arstok = mysqli_fetch_array($qrymenu);
    $stok = $arstok['stok'];
    $jmlh=$_GET['jmlh'];
    $hasil = $stok + $jmlh;
    $qryinsert = mysqli_query($datapesanan->koneksi,"UPDATE menu SET stok='$hasil' where id_makanan='$id_makanan'");

    //kembali ke halaman index 
    header('location:index.php');
}
?>