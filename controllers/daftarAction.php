<?php
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';
// require "../vendor/autoload.php";
// require "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
// require "../vendor/phpmailer/phpmailer/src/SMTP.php";
// require "../vendor/phpmailer/phpmailer/src/Exception.php";
require_once "../config.php";

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaLengkap = $_POST["namaLengkap"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $verificationNumber = mt_rand(100000, 999999);
    $isVerified = 0;
    $level = "user";

    // Validasi data
    if (empty($namaLengkap) || empty($email) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Semua kolom harus diisi.'];
    } else {
        // Cek apakah email sudah ada di database
        $sql_check_email = "SELECT * FROM ptb_master_user WHERE Email = ?";
        $stmt_check_email = $connection->prepare($sql_check_email);
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->get_result();

        if ($result_check_email->num_rows > 0) {
            $response = ['status' => 'error', 'message' => 'Alamat email sudah digunakan.'];
        } else {
            // Enkripsi password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Simpan data ke database
            $sql_insert_user = "INSERT INTO ptb_master_user (Nama_Lengkap, Email, Passwd, IsVerified, VerificationCode, Level, TimeCreated) VALUES (?, ?, ?, ? ,?, ?, NOW())";
            $stmt_insert_user = $connection->prepare($sql_insert_user);
            $stmt_insert_user->bind_param("sssiis", $namaLengkap, $email, $hashedPassword, $isVerified, $verificationNumber, $level);

            if ($stmt_insert_user->execute()) {

                $mail = new PHPMailer(true);
                $mail->setLanguage(CONTACTFORM_LANGUAGE);
                $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
                $mail->isSMTP();
                $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
                $mail->SMTPAuth = true;
                $mail->Username = CONTACTFORM_SMTP_USERNAME;
                $mail->Password = CONTACTFORM_SMTP_PASSWORD;
                $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
                $mail->Port = CONTACTFORM_SMTP_PORT;
                $mail->CharSet = CONTACTFORM_MAIL_CHARSET;
                $mail->Encoding = CONTACTFORM_MAIL_ENCODING;
          
                $mail->setFrom('portalswebs78@gmail.com', 'Verifikasi Email');
                $mail->addAddress($email, $namaLengkap);

                $mail->isHTML(true);
                $mail->Subject = 'Kode Verifikasi';
                $mail->Body = 'Kode verifikasi Anda: ' . $verificationNumber;

                $sql_call_event = "UPDATE ptb_master_user SET VerificationCode = NULL WHERE Email = ? AND TimeCreated < NOW() - INTERVAL 15 MINUTE";
                $stmt_call_event = $connection->prepare($sql_call_event);
                $stmt_call_event->bind_param("s", $email);
                $stmt_call_event->execute();
                $stmt_call_event->close();

                if ($mail->send()) {
                    $response = ['status' => 'success', 'message' => 'Daftar akun berhasil, silahkan cek email anda untuk verifikasi', 'email' => $email];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal mengirim email verifikasi: ' . $mail->ErrorInfo];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Gagal menyimpan data ke database.'];
            }

            $stmt_insert_user->close();
        }
        $stmt_check_email->close();
    }


    header('Content-Type: application/json');


    echo json_encode($response);
}

$connection->close();
?>
