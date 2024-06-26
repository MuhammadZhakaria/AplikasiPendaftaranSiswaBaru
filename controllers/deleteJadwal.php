<?php 

session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
     exit;
}

    include 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id_jadwal = $_POST['id_jadwal'];

        $query = "DELETE FROM ptb_jadwal_pendaftaran WHERE Id_jadwal = ?";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id_jadwal);

        if($stmt->execute()){
            $response = ['status' => 'success', 'message' => 'Data jadwal berhasil dihapus'];

        }else{
            echo "Error: " . $stmt->error;
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data'];
        }

        $stmt->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    $connection->close();
?>