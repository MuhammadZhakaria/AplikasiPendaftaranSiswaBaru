<?php
session_start();

$response = [];

if (isset($_SESSION['id_user'])) {
    // Hapus semua variabel sesi
    session_unset();

    // Hapus sesi
    session_destroy();

    $response['status'] = 'success';
    $response['message'] = 'Logout berhasil';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Anda tidak masuk. Tidak ada sesi aktif.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
