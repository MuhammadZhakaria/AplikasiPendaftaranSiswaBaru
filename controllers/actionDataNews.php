<?php

    session_start();
    if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
    }else{
        header("location: Error");
        exit;
    }

include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $optionalFiles = isset($_FILES['optional-files']) ? $_FILES['optional-files'] : null;

    if ($optionalFiles && $optionalFiles['error'] === UPLOAD_ERR_OK) {
        $fileContent = file_get_contents($optionalFiles['tmp_name']);
    } else {
        $fileContent = null;
    }

    $content = $_POST['content'];
    $date_created = date("Y-m-d H:i:s");

    $sql = "INSERT INTO ptb_master_news(content_news, Date_Created, files) VALUES (?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $content, $date_created, $fileContent);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Data berhasil di Publish'];
    } else {
        echo "Error" . $stmt->error;
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menyimpan data'];
    }

    $stmt->close();

    echo json_encode($response);
}

$connection->close();
?>
