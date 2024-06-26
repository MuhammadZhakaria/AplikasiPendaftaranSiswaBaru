<?php

session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
     exit;
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kegiatan = $_POST["id_kegiatan"];

    $deleteQuery = "DELETE FROM ptb_jadwal_kegiatan WHERE Id_Kegiatan = ?";
    $stmt = $connection->prepare($deleteQuery);
    $stmt->bind_param("i", $id_kegiatan);

    if ($stmt->execute()) {
        $resetAutoIncrementQuery = "ALTER TABLE ptb_jadwal_kegiatan AUTO_INCREMENT = 1";
        $connection->query($resetAutoIncrementQuery);

        $response = ['status' => 'success', 'message' => 'Data berhasil dihapus'];
    } else {
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data: ' . $stmt->error];
    }

    $stmt->close();
    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();
?>
