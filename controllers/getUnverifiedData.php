<?php 
session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
    exit;
}
include 'config.php';

    $query = "SELECT a.Id_calonSiswa, a.NamaLengkap, a.NISN, a.Email, a.JenisKelamin, a.NoHp
              FROM ptb_master_datasiswa AS a
              LEFT JOIN ptb_verifiedpendaftaran AS b ON a.Id_calonSiswa = b.Id_calonSiswa
              WHERE b.IsVerified = 0 OR b.IsVerified IS NULL";

    $result = $connection->query($query);

    $data = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }

    echo json_encode($data);
    $connection->close();

?>