<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";
require "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "../vendor/phpmailer/phpmailer/src/SMTP.php";
require "../vendor/phpmailer/phpmailer/src/Exception.php";

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $verificationNumber = mt_rand(100000, 999999);
    $level = "user";

    // Validasi data
    if (empty($email)) {
        $response = ['status' => 'error', 'message' => 'Semua kolom harus diisi.'];
    } else {
        // Cek apakah email sudah ada di database
        $sql_check_email = "SELECT * FROM ptb_master_user WHERE Email = ?";
        $stmt_check_email = $connection->prepare($sql_check_email);
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->get_result();

        if ($result_check_email->num_rows > 0) {
            $sql_insert_user = "UPDATE ptb_master_user SET VerificationCode = ?, TimeCreated = NOW() WHERE Email = ? AND Level = ?";
            $stmt_insert_user = $connection->prepare($sql_insert_user);
            $stmt_insert_user->bind_param("iss", $verificationNumber, $email, $level);

            if ($stmt_insert_user->execute()) {

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'portalswebs78@gmail.com';
                $mail->Password = 'nilu lfra wyrh xbih';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
          
                $mail->setFrom('portalswebs78@gmail.com', 'Verifikasi Email');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Kode Verifikasi';
                $mail->Body = 'Kode verifikasi Anda: ' . $verificationNumber;

                $sql_call_event = "UPDATE ptb_master_user SET VerificationCode = NULL WHERE Email = ? AND TimeCreated < NOW() - INTERVAL 15 MINUTE";
                $stmt_call_event = $connection->prepare($sql_call_event);
                $stmt_call_event->bind_param("s", $email);
                $stmt_call_event->execute();
                $stmt_call_event->close();

                if ($mail->send()) {
                    $response = ['status' => 'success', 'message' => 'Code verifikasi telah dikirim, silahkan cek email anda'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal mengirim email verifikasi: ' . $mail->ErrorInfo];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Gagal menyimpan data ke database.'];
            }

            $stmt_insert_user->close();
        } else {
        $response = ['status' => 'error', 'message' => 'Email tidak ditemukan'];
        }
        $stmt_check_email->close();
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();
?>
