<?php
session_start();
include 'config.php';

if (isset($_SESSION['id_user'])) {
    $Id_users = $_SESSION['id_user'];

    $sql_select = "SELECT Id_calonSiswa, NamaLengkap, Email, NISN, JenisKelamin, TempatLahir, TanggalLahir, NoHp, Agama, Alamat, FotoSiswa, FileNames FROM ptb_master_datasiswa WHERE user_Id=?";
    $stmt_select = $connection->prepare($sql_select);
    $stmt_select->bind_param("i", $Id_users);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Konversi data gambar menjadi format Base64
        $imageData = $row['FotoSiswa'];
        $base64Image = base64_encode($imageData);
        $row['FotoSiswa'] = $base64Image;

        $_SESSION['Id_calonSiswa'] = $row['Id_calonSiswa'];

        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }

    $stmt_select->close();
} else {
    echo json_encode(['error' => 'Id_users tidak tersedia dalam sesi']);
}
?>
