<?php 
    include 'config.php';

    session_start();
    if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
    }else{
        header("location: Error");
        exit;
    }

    $query = "SELECT NamaLengkap, NISN, JenisKelamin, Email, NoHp, TanggalVerifikasi FROM ptb_verifiedpendaftaran";
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