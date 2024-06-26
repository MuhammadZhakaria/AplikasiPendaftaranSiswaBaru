<?php
session_start();
include 'config.php';

$Email = $_POST['Email'];
$Password = $_POST['Password'];


$query = "SELECT user_Id, Nama_Lengkap, Email, Passwd, Level, IsVerified FROM ptb_master_user WHERE Email = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $Email);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if ($row['IsVerified'] == 1) {
        if (password_verify($Password, $row['Passwd'])) {
            $_SESSION['id_user'] = $row['user_Id'];
            $_SESSION['nama_lengkap'] = $row['Nama_Lengkap'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['user_level'] = $row['Level'];
            
            $response['status'] = "success";
            $response['level'] = $row['Level'];
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Email atau password salah';
        }
    } else {
    $response = ['status' => 'notVerified', 'message' => 'Akun anda belum di verifikasi, cek email anda untuk mendapatkan code', 'email' => $Email];
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Email tidak ditemukan';
}

header('Content-Type: application/json');
echo json_encode($response);

$connection->close();
?>
