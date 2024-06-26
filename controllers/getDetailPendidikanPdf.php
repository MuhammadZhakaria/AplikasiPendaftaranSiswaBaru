<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
    exit;
}

include 'config.php';

if (isset($_GET['id_calonSiswa'])) {
    $id_calonSiswa = $_GET['id_calonSiswa'];

    $query = "SELECT filesIN 
              FROM ptb_master_pendidikan
              WHERE Id_calonSiswa = $id_calonSiswa";

    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set header untuk tipe konten PDF
        header("Content-type: application/pdf");
        

        // Tampilkan data PDF langsung dari database
        echo $row['filesIN'];
    } else {
        echo "Gagal mengambil file PDF dari database.";
    }

    $connection->close();
}
?>