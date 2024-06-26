<?php

session_start();
if(!$_SESSION['id_user']){
    header("location: Login");
}


include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asalSekolah = $_POST["asalSekolah"];
    $alamatSekolah = $_POST["alamatSekolah"];
    $thunMasuk = $_POST["thunMasuk"];
    $thuhLulus = $_POST["thuhLulus"];
    $id_calonsiswa = $_SESSION['Id_calonSiswa'];

    $chekSql = "SELECT IdPendidikan FROM ptb_master_pendidikan WHERE Id_calonSiswa = ?";
    $checkStmt = $connection->prepare($chekSql);
    $checkStmt->bind_param("i", $id_calonsiswa);
    $checkStmt->execute();
    $checkStmt->store_result();

    if($checkStmt->num_rows > 0){
        $updateSql = "UPDATE ptb_master_pendidikan SET NamaSekolah=?, AlamatSekolah=?, TahunMasuk=?, TahunKeluar=? WHERE Id_calonSiswa=?";
        $stmt = $connection->prepare($updateSql);
        $stmt->bind_param("ssiii", $asalSekolah, $alamatSekolah, $thunMasuk, $thuhLulus, $id_calonsiswa);
    }else{
        $sql = "INSERT INTO ptb_master_pendidikan (Id_calonSiswa, NamaSekolah, AlamatSekolah, TahunMasuk, TahunKeluar ) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issii", $id_calonsiswa, $asalSekolah, $alamatSekolah, $thunMasuk, $thuhLulus);
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