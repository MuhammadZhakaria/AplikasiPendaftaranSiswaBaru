<?php 
session_start();

function checkAdminSession() {
    if (!isset($_SESSION['id_user']) || $_SESSION['user_level'] !== 'admin') {
        header("location: Error");
        exit;
    }
}

function getRequestedFile($connection, $id_calonSiswa) {
    $query = "SELECT FileIjazah, FileRaport, KartuKeluarga, AkteLahir
              FROM ptb_master_berkas
              WHERE Id_calonSiswa = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id_calonSiswa);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->fetch_assoc();
}

function sendFile($fileContent) {
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline");
    echo $fileContent;
}

function handleFileRequest($fileData) {
    $fileKey = $_GET['file'] ?? null;

    switch ($fileKey) {
        case 'KartuKeluarga':
            sendFile($fileData['KartuKeluarga']);
            break;
        case 'AkteLahir':
            sendFile($fileData['AkteLahir']);
            break;
        case 'FileIjazah':
            sendFile($fileData['FileIjazah']);
            break;
        case 'FileRaport':
            sendFile($fileData['FileRaport']);
            break;
        default:
            echo "Invalid Request";
            break;
    }
}

function main() {
    checkAdminSession();

    if (!isset($_GET['id_calonSiswa'])) {
        echo "Gagal mengambil file PDF dari database";
        return;
    }

    $id_calonSiswa = $_GET['id_calonSiswa'];
    include 'config.php';

    $fileData = getRequestedFile($connection, $id_calonSiswa);
    $connection->close();

    if ($fileData) {
        handleFileRequest($fileData);
    } else {
        echo "Data tidak ditemukan";
    }
}


main();
?>
