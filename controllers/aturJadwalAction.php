<?php

session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
     exit;
}

include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $tanggalBuka = $_POST["tanggalBuka"];
    $tanggalTutup = $_POST["tanggalTutup"];

    $sql = "INSERT INTO ptb_jadwal_pendaftaran (TanggalBuka, TanggalTutup) VALUES(?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $tanggalBuka, $tanggalTutup);

    if($stmt->execute()){
        $response = ['status' => 'success', 'message' => 'Jadwal berhasil disimpan'];
    }else{
       $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data'];
    }

    $stmt->close();
    echo json_encode($response);
}

$connection->close();
?>