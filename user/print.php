<?php
    include( 'fungsi.php' );
    $data = new datapesanan();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>


    <?php
      $id = $_POST['id'];
      $no = $_POST['no'];

      $qrycari = mysqli_query($data->koneksi,"select transaksi.*,detail_transaksi.*,menu.nama_makanan from transaksi,detail_transaksi,menu where transaksi.id_user='$id' and transaksi.id_transaksi='$no' and detail_transaksi.id_transaksi=transaksi.id_transaksi AND menu.id_makanan=detail_transaksi.id_makanan ORDER BY transaksi.id_transaksi DESC");

    ?>
<div id="print" >
    <center>
        <label>=============================</label>
        <div>Struk Pembayaran</div>
        <br><br><br>
        <table>
            <?php
                foreach ($qrycari as $key) {
                    
                
            ?>
            <tr>
                <th><?=$key['nama_makanan']?></th>
                <td>........................</td>
                <td>x<?=$key['qty']?>...</td>
                <td>Rp.<?=$key['sub_total']?></td>
            </tr>
            <?php
                }
            ?>
            <tr><td></td><td></td></tr><tr><td></td><td></td></tr><tr><td></td><td></td></tr>
            <tr>
                <th>Total</th>
                <td>........................</td>
                <td>.....</td>
                <td>Rp.<?=$key['total']?></td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <div>Terimakasih</div>
        <label>============================</label>
    </center>
</div>
<center>
<button onclick="struk('print')" class="btn btn-outline-dark">Print</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button class="btn btn-outline-dark"><a href="riwayat.php" >kembali</a></button>
</center>
</body>
            <script>    
                function struk(el) {
                    var restorepage = document.body.innerHTML;
                    var printcontent = document.getElementById(el).innerHTML;
                    document.body.innerHTML = printcontent;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            
            </script>
</html>

