<?php
    session_start();
    //include data yng ada pada file config.php
    include('../config.php');
    // include('proses_cari_by_noTran.php');
    // objek childe dari parret database
    class datapesanan extends database{

        

        //fungsi / method untuk menampilkan option pada input makanan
        function data_menu(){

            //ambil data nama _makanan yang ada di  table menu lalu di tampilkan melalui select option
			$query = mysqli_query($this->koneksi,"select * from menu ");

			while ($arr = mysqli_fetch_array($query)) {
				?>
					<option value="<?= $arr['nama_makanan'] ?>"><?= $arr['nama_makanan'] ?></option>
				<?php
			}
        }
        
        // method untuk menyimpan ke detail transaksi
        function simpan_data(){
            // kondisi jika btn-simpan di klick
            if (isset($_POST['btn-simpan'])) {
                //data menu 
                $menu = $_POST['menu'];
                //memanggil method dari class orang tua untuk mendambil id
                $id_makanan = $this->getId('menu','nama_makanan',$menu,'id_makanan');
                //data jumlah
                $jumlah=$_POST['jumlah'];
                //memenggil method dari class parrent/orang tua untuk mengambil harga
                $harga = $this->getId('menu','nama_makanan',$menu,'harga');
                //perhitungan harga di kali jumlah banyaknya pesanan
                $subharga = $jumlah * $harga;
                
                //cek apakah table transaksi sudh ada isinya atau belum
                $query = mysqli_query($this->koneksi,"select * from transaksi order by id_transaksi desc");
                $arrTransaksi = mysqli_fetch_array($query);
                
                //$id berfungsi sebagai id yg akan di inputkan di detail 
                //jika pada tb transaksi msh belum ada idinya maka num akan di tambah 1 

                $idtr = $arrTransaksi['id_transaksi'];
                $id = $idtr+1;
                 //cek stok makanan
                 $stok = $this->getId('menu','nama_makanan',$menu,'stok');
                 // joka stok kosong
                if ($stok <= 0) {
                     ?>
                     <script>
                        alert("Stok kosong");
                        document.location = 'index.php';
                    </script>
                     <?php
                     
                 } else{  
                     //jika stok msh ada
                     if ($stok < $jumlah) {
                        ?>
                        <script>
                           alert("Stok kurang");
                           document.location = 'index.php';
                       </script>
                        <?php
                     }else {
                        $query = mysqli_query($this->koneksi,"insert into detail_transaksi values('$id','$id_makanan','$jumlah','$subharga')");
                        header('location:index.php');          
                     }

                 }
            }
        }

  

        //method untuk menampilkan table pesanan pembeli sebelum di chekout/bayar
        function tampil_detail_transaksi(){

            //menegecek apakan tb transaksi ada terdapat sisnya atau tidak
            $query = mysqli_query($this->koneksi,"select * from transaksi order by id_transaksi desc");
            $arrTransaksi = mysqli_fetch_array($query);
            $num = mysqli_num_rows($query);

            $idtr = $arrTransaksi['id_transaksi'];
            $id = $idtr+1;
            //jika tidak terdapat rowsnya / isinya 
             
                $qdata = mysqli_query($this->koneksi,"select * from detail_transaksi ,menu where id_transaksi ='$id' and detail_transaksi.id_makanan=menu.id_makanan order by id_transaksi desc");

                // cek apakan row data sudah di inputkan atau belum jika belum makatampil data kosong
                 $row = mysqli_num_rows($qdata);
                if ($row == 0) {
                    ?>
                            <td></td>
                            <td> data kosong silahkan input menu </td>
                            <td></td>
                            <td></td>
                    <?php
                }else{
                while ($arr= mysqli_fetch_array($qdata)) {
                    
                    ?>
                        <tr class="table-light">
                        <td><?= $arr['nama_makanan']; ?></td>
                        <td><?= $arr['qty']; ?></td>
                        <td><?= date('Y-m-j'); ?></td>
                        <td><?= $arr['sub_total']; ?></td>
                        <td><button type="submit" class="btn btn-danger" name="btn-hapus-pesanan"><a href="proses_pemesanan.php?action=delete&id=<?=$arr['id_makanan'];?>&jmlh=<?=$arr['qty'];?>"><img src="../images/sampah.svg" alt="" width="25" height="25" class="d-inline-block align-top"></a></button></td>
                        </tr>
                    <?php
                }
                ?>
                    <tr class="table-light">
                    <form action="proses_pemesanan.php" method="post">
                       

                        <td></td>
                        <td>total</td>
                        <td></td>
                        <td>
                            <?php 

                                $qry = mysqli_query($this->koneksi,"select sum(sub_total) as total from detail_transaksi where id_transaksi = '$id' ");
                                $arr = mysqli_fetch_array($qry);
                                echo $arr['total'];           
                               
                            ?>
                        </td>
                        <td>
                            <input type="submit" value="bayar" class="btn btn-primary" name="btn-bayar">
                        </td>
                    </form>
                    </tr>
                <?php 
                }

        }


        function bayar(){
            
            //menegecek apakan tb transaksi ada terdapat sisnya atau tidak
            $query = mysqli_query($this->koneksi,"select * from transaksi order by id_transaksi desc");
            $arrTransaksi = mysqli_fetch_array($query);
            $num = mysqli_num_rows($query);

            $idtr = $arrTransaksi['id_transaksi'];
            $id = $idtr+1;

            $qry = mysqli_query($this->koneksi,"select sum(sub_total) as total from detail_transaksi where id_transaksi = '$id' ");
            $arr = mysqli_fetch_array($qry);

                $total = $arr['total'];
     
                $tgl = date('Y-m-j');

                    $username = $_SESSION['username'];
                    $datauser = mysqli_query($this->koneksi,"select * from user where username = '$username' ");
                    $arruser = mysqli_fetch_array($datauser);
                    $user = $arruser['id_user'];
                    echo $tgl;
                 mysqli_query($this->koneksi,"insert into transaksi values('$id','$tgl','$user','$total')");
                 header('location:index.php');
            
        }

    }
?>