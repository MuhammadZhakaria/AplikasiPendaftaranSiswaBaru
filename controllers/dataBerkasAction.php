<?php

session_start();
if(!$_SESSION['id_user']){
    header("location: Login");
}


include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileIjazah = file_get_contents($_FILES['fileIjazah']['tmp_name']);
    $fileRaport = file_get_contents($_FILES['fileRaport']['tmp_name']);
    $kartuKeluarga = file_get_contents($_FILES['kartuKeluarga']['tmp_name']);
    $akteLahir = file_get_contents($_FILES['akteLahir']['tmp_name']);
    $id_calonsiswa = $_SESSION['Id_calonSiswa'];

    
    $checkSql = "SELECT Id_berkas FROM ptb_master_berkas WHERE Id_calonSiswa = ? ";
    $checkStmt = $connection->prepare($checkSql);
    $checkStmt->bind_param("i", $id_calonsiswa);
    $checkStmt->execute();
    $checkStmt->store_result();

    if($checkStmt->num_rows > 0){
        $updateSql = "UPDATE ptb_master_berkas SET FileIjazah=?, FileRaport=?, KartuKeluarga=?, AkteLahir=? WHERE Id_calonSiswa=?";
        $stmt = $connection->prepare($updateSql);
        $stmt->bind_param("ssssi", $fileIjazah, $fileRaport, $kartuKeluarga, $akteLahir, $id_calonsiswa);
    }else{
        $sql = "INSERT INTO ptb_master_berkas (Id_calonSiswa, FileIjazah, FileRaport, KartuKeluarga, AkteLahir) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issss",$id_calonsiswa, $fileIjazah, $fileRaport, $kartuKeluarga, $akteLahir);
    }
    
    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Data berhasil disimpan'];
    } else {
        echo "Error: " . $stmt->error;
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menyimpan data.'];
    }

    $stmt->close();
    
    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();
?>