<?php 
		
	class database{
		var $host = "localhost";
		var $username = "root";
		var $password = "";
		var $db = 'pemesanan_makanan';
		var $koneksi = "";

		//koneksi database 
		function __construct(){
			$koneksi = $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->db);
			mysqli_error($koneksi);
		}

		//ambil data dari database by id ;
		function getId($tabel,$patokan,$p,$diambil){
			$hasil = mysqli_query($this->koneksi, "select * from $tabel where $patokan = '$p' ");
			$arr = mysqli_fetch_array($hasil);		
			return $arr[$diambil];	
		}
		//admbil data
		function ambildata_riwayat($nama_table,$nama_table2){
			$qry = mysqli_query($this->koneksi,"SELECT $nama_table.*,$nama_table2.* from $nama_table,$nama_table2 where $nama_table.id_user = $nama_table2.id_user order by $nama_table.id_transaksi DESC");
			while($ar = mysqli_fetch_array($qry)){
				$hasil[]=$ar;
			}
			return $hasil;
		}

		//ambildata detail
		function data_detail($a,$b,$c)
		{
			$qry = mysqli_query($this->koneksi,"SELECT $a.*,$b.*,$c.* from $a,$b,$c where $a.id_transaksi = $b.id_transaksi and $b.id_makanan = $c.id_makanan order by $a.id_transaksi DESC");
			while($ar = mysqli_fetch_array($qry)){
				$hasil[]=$ar;
			}
			return $hasil;
		}

	}

	// $database = new database();
	// $data = $database->ambildata_byId('user','1');
	// echo $data['nama'],$data['username'];
	// echo "<br>";


?>
