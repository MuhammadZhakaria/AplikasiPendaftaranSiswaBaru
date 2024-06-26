<?php
    session_start();

    include 'config.php';

    $IsVerified = 1;
    $Status = "Dalam Proses Seleksi";
    $Id_users = $_SESSION['id_user'];

   
    $sql = "INSERT INTO ptb_verifiedpendaftaran (Id_calonSiswa, NamaLengkap, NISN, JenisKelamin, Email, NoHP, TanggalVerifikasi, IsVerified, Status)
            SELECT Id_calonSiswa, NamaLengkap, NISN, JenisKelamin, Email, NoHp, NOW(), ?, ?
            FROM ptb_master_datasiswa
            WHERE user_Id=?";

   
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        die("Kesalahan dalam menyiapkan pernyataan SQL: " . $connection->error);
    }

    
    $stmt->bind_param("isi", $IsVerified, $Status, $Id_users);


    if ($stmt->execute()) {
        
        $response = ['status' => 'success', 'message' => 'Data berhasil di verifikasi.'];
        echo json_encode($response);
    } else {
        $response = ['status' => 'error', 'message' => 'Gagal verifikasi data' . $stmt->error];
        echo json_encode($response);
    }

    
     header('Content-Type: application/json');

    $stmt->close();
    $connection->close();
?>
