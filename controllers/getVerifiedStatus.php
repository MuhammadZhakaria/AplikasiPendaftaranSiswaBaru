<?php 

include 'config.php';
 
    session_start();

$response = ['status' => 'error', 'message' => 'Gagal, Terjadi Kesalahan dalam memuat data', 'IsVerified' => false];


if(isset($_SESSION['Id_calonSiswa'])){
    $Id_calonSiswa = $_SESSION['Id_calonSiswa'];

    $query = "SELECT IsVerified, Status FROM ptb_verifiedpendaftaran WHERE Id_calonSiswa = ?";

    $stmt = $connection->prepare($query);

    if($stmt === false){
        $response['message'] = 'Terjadi Kesalahan dalam memuat data' . $connection->error;
    }else{
        
        $stmt->bind_param("i", $Id_calonSiswa);

        if($stmt->execute()){
            $stmt->bind_result($IsVerified, $Status);
            $stmt->fetch();

            $response = ['status' => 'success', 'Message' => '200ok', 'IsVerified' => (bool) $IsVerified, 'Status' => $Status];

            
        }else{
            $response['message'] = 'Gagal mengambil data' . $stmt->error;
        }
        $stmt->close();
    }
}else{
    $response['message'] = 'Id_calonSiswa tidak ditemukan dalam sesi';
}

$connection->close();

header('Content-Type: application/json');
echo json_encode($response);

?>