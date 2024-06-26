<?php

session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
     exit;
}
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenisKegiatan = $_POST["jenisKegiatan"];
    $tanggalBuka = $_POST["tanggalBuka"];
    $tanggalTutup = $_POST["tanggalTutup"];

  //reset auto increment to zero when add new entry
    $updateQuery = "SET @num := 0; UPDATE ptb_jadwal_kegiatan SET Id_Kegiatan = @num := (@num + 1);";
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

    $alterQuery = "ALTER TABLE ptb_jadwal_kegiatan AUTO_INCREMENT = 1;";
    if ($connection->query($alterQuery) === TRUE) {

        $insertQuery = "INSERT INTO ptb_jadwal_kegiatan (JenisKegiatan, TanggalDibuka, TanggalDitutup) VALUES (?, ?, ?);";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param("sss", $jenisKegiatan, $tanggalBuka, $tanggalTutup);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Kegiatan berhasil disimpan'];
        } else {
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menyimpan data: ' . $stmt->error];
        }

        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam query ALTER TABLE: ' . $connection->error];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Metode HTTP tidak valid'];
}


$connection->close();


header('Content-Type: application/json');
echo json_encode($response);
?>
