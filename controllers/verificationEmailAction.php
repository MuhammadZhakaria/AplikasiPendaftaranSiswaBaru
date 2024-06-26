<?php
include 'config.php';

// Inisialisasi respons awal
$response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam memproses verifikasi.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $verificationCode = $_POST['verificationCode'];
    $isVerified = 1;

    // Query SQL untuk memperbarui status verifikasi
    $sql = "UPDATE ptb_master_user SET IsVerified = ? WHERE Email = ? AND VerificationCode = ?";
    
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        $response['message'] = 'Kesalahan dalam menyiapkan pernyataan SQL: ' . $connection->error;
    } else {
        // Ikat parameter ke pernyataan SQL
        $stmt->bind_param("isi", $isVerified, $email, $verificationCode);
        if ($stmt->execute()) {
            // Verifikasi berhasil
            if ($stmt->affected_rows > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Verifikasi berhasil.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Verifikasi gagal: Kode verifikasi salah atau email tidak ditemukan.';
            }
        }else {
            $response['message'] = 'Gagal verifikasi: ' . $stmt->error;
        }

        $stmt->close();
    }
}

$connection->close();

// Kembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
