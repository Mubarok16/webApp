<?php

class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "pemesanan_makanan";
    var $koneksi = "";

	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
    }
    
    function cek_password($username, $password){
        $query = mysqli_query($this->koneksi,"select * from user where username = '$username' AND password = '$password' ");
        $result = mysqli_num_rows($query);
         if($result > 0) {
            header('location:formUser/index.php');
         }else {
             header('location:index.php');
         }
    }
    function edit_data($id,$a,$b,$c,$d,$e){
        
    }
}