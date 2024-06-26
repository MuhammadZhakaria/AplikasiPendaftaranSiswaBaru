<?php

    include 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $token = $_POST["token"];
        $password = $_POST["password"];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query_update = "UPDATE ptb_master_user SET Passwd = ? WHERE Token = ?";
        $stmt_update = $connection->prepare($query_update);
        $stmt_update->bind_param("ss", $hashedPassword, $token);

        if($stmt_update->execute()){
            $response = ['status' => 'success', 'message' => 'Password berhasil diubah'];
        }else{
            $response = ['status' => 'error', 'message' => 'Token kadaluarsa'];
        }

        $stmt_update->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    $connection->close();

?>