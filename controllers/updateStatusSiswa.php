<?php 

    session_start();
    if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
    }else{
        header("location: Error");
        exit;
    }

    include 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id_calonSiswa = $_POST['id_calonSiswa'];
        $selectedStatus = $_POST['status'];

        $query = "UPDATE ptb_verifiedpendaftaran SET Status=?
                 WHERE Id_calonSiswa = ?";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("si",$selectedStatus, $id_calonSiswa);

        if($stmt->execute()){
            $response = ['status' => 'success', 'message' => 'Status berhasil di update'];
        }else{
            echo "Error: " . $stmt->error;
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data'];
        }

        $stmt->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    $connection->close();
?>