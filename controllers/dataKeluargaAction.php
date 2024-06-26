<?php 

session_start();
if(!$_SESSION['id_user']){
    header("location: Login");
}
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $namaAyah = $_POST["namaAyah"];
    $namaIbu = $_POST["namaIbu"];
    $kontakOrtu = $_POST["kontakOrtu"];
    $namaWali = $_POST["namaWali"];
    $hubungan = $_POST["hubungan"];
    $kontakWali = $_POST["kontakWali"];
    $id_calonsiswa = $_SESSION['Id_calonSiswa'];
    
    $checkSql = "SELECT Id_Keluarga FROM ptb_master_datakeluarga WHERE Id_calonSiswa=?";
    $checkStmt = $connection->prepare($checkSql);
    $checkStmt->bind_param("i", $id_calonsiswa);
    $checkStmt->execute();
    $checkStmt->store_result();

    if($checkStmt->num_rows > 0){
        $updateSql = "UPDATE ptb_master_datakeluarga SET NamaAyah=?, NamaIbu=?, KontakOrtu=?, NamaWali=?, Hubungan=?, KontakWali=? WHERE Id_calonSiswa=?";
        $stmt = $connection->prepare($updateSql);
        $stmt->bind_param("ssssssi", $namaAyah, $namaIbu, $kontakOrtu, $namaWali, $hubungan, $kontakWali, $id_calonsiswa);
    }else{
        $sql = "INSERT INTO ptb_master_datakeluarga (Id_calonSiswa, NamaAyah, NamaIbu, KontakOrtu, NamaWali, Hubungan, KontakWali) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issssss", $id_calonsiswa, $namaAyah, $namaIbu, $kontakOrtu, $namaWali, $hubungan, $kontakWali);
    }
    
    if($stmt->execute()){
        $response = ['status' => 'success', 'message' => 'Data berhasil disimpan'];
    }else{
        echo "Error: " . $stmt->error;
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menyimpan data.'];
    }

    $stmt->close();

    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();
?>