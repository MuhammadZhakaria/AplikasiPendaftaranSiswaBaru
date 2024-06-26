<?php

//deklasrasi variabel
$db_host = "localhost";
$db_user = "psbf3645_adminsmandu";
$db_pass = "AdminSmandu123";
$db_name = "psbf3645_mptsiswa";    

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if($connection) {
    //echo "Koneksi Berhasil!";
} else {
    echo "Koneksi Gagal! : ". mysqli_connect_error();
}

?>