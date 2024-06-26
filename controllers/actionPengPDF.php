<?php

    include 'config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_FILES['filePengumuman'])) {
                $filePengumuman = $_FILES['filePengumuman'];

                // Check if there is no upload error
                if ($filePengumuman['error'] === UPLOAD_ERR_OK) {
                    // Read the file content
                    $fileContent = file_get_contents($filePengumuman['tmp_name']);
                } else {
                    // Handle the case where there is an upload error
                    $fileContent = null;
                    $response = ['status' => 'error', 'message' => 'Error uploading file.'];
                    echo json_encode($response);
                    exit(); // Stop further execution
                }
            } else {
                // Handle the case where the file field is not set
                $fileContent = null;
            }

 $titlePengumuman = $_POST["titlePengumuman"];  

        $insert_query = "INSERT INTO ptb_pengumuman(TitlePengumuman, FilePengumuman) VALUES(?,?)";
        $stmt = $connection->prepare($insert_query);
        $stmt->bind_param("ss", $titlePengumuman, $fileContent);
        if($stmt->execute()){
            $response = ['status' => 'success', 'message' => 'Data berhasil dipublish'];
        }else{
            $response = ['status' => 'error', 'message' => 'Terjadi Kesalahan, silahkan coba lagi nanti'];
        }

        $stmt->close();
        echo json_encode($response);
    }

    $connection->close();

?>