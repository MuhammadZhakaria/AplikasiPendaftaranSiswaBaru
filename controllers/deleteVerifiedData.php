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


        $updateQuery = "SET @num := 0; UPDATE ptb_verifiedpendaftaran SET IdVerification = @num := (@num + 1);";
        if ($connection->multi_query($updateQuery)) {
            do {

                if ($result = $connection->store_result()) {
                    $result->free();
                }
            } while ($connection->more_results() && $connection->next_result());
        } else {
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam query UPDATE: ' . $connection->error];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $alterQuery = "ALTER TABLE ptb_verifiedpendaftaran AUTO_INCREMENT = 1;";
        if ($connection->query($alterQuery) === TRUE) {

            $query = "DELETE FROM ptb_verifiedpendaftaran 
                  WHERE Id_calonSiswa = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $id_calonSiswa);

            if($stmt->execute()){
                $response = ['status' => 'success', 'message' => 'Data berhasil dihapus'];
            }else{
                echo "Error: " . $stmt->error;
                $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data'];
            }
            $stmt->close();
        } else {
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam query ALTER TABLE: ' . $connection->error];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    $connection->close();
?>