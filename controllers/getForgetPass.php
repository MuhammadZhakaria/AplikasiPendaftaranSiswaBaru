<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require "../vendor/autoload.php";
    require "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "../vendor/phpmailer/phpmailer/src/SMTP.php";
    require "../vendor/phpmailer/phpmailer/src/Exception.php";

    include 'config.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];

        $token = bin2hex(random_bytes(32));
        $level = "user";

        $query = "SELECT Email FROM ptb_master_user WHERE Email = ? AND Level = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss", $email, $level);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $query_update = "UPDATE ptb_master_user SET Token = ?, TokenTimeStamp = NOW() WHERE Email = ?";
            $stmt_update = $connection->prepare($query_update);
            $stmt_update->bind_param("ss", $token, $email);
            
            if($stmt_update->execute()){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'portalswebs78@gmail.com';
            $mail->Password = 'nilu lfra wyrh xbih';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('portalswebs78@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            
            $reset_link = "https://psbsma2tondano.online/lupa-password/create-new-password/?token=$token"; 

            $mail->isHTML(true);
            $mail->Subject = 'Link Reset Password';
            $mail->Body = 'Klik link ini untuk reset password anda ' . $reset_link;
            
            $sql_change_Token = "UPDATE ptb_master_user SET Token = NULL WHERE Email='$email' AND TokenTimeStamp < NOW() - INTERVAL 3 MINUTE";
            $connection->query($sql_change_Token);

                if($mail->send()){
                    $response = ['status' => 'success', 'message' => 'Link Reset Password telah di kirim, silahkan cek email anda'];
                }else{
                    $response = ['status' => 'error', 'message' => 'Gagal mengirim link, silahkan coba lagi nanti'];
                }
            }
            $stmt_update->close();
        }else{
            $response = ['status' => 'error', 'message' => 'Email belum terdaftar, silahkan daftar terlebih dahulu'];
        }
        $stmt->close();

        header('Content-Type: application/json');

        echo json_encode($response);

    $connection->close();
    }

?>