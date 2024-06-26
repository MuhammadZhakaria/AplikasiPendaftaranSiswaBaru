<?php

session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
     exit;
}
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_news = $_POST['id_news'];


    $content_query = "SELECT content_news FROM ptb_master_news WHERE Id_news = ?";
    $content_stmt = $connection->prepare($content_query);
    $content_stmt->bind_param("i", $id_news);
    $content_stmt->execute();
    $content_stmt->bind_result($content_news);
    $content_stmt->fetch();
    $content_stmt->close();


    $file_paths = extractFilePathsFromHtml($content_news);


    $delete_success = true;
    foreach ($file_paths as $file_path) {

        if (!empty($file_path) && file_exists($file_path)) {

            if (!unlink($file_path)) {
                $delete_success = false;
                break; 
            }
        }
    }

    if ($delete_success) {

        $delete_query = "DELETE FROM ptb_master_news WHERE Id_news = ?";
        $delete_stmt = $connection->prepare($delete_query);
        $delete_stmt->bind_param("i", $id_news);

        if ($delete_stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Data berhasil dihapus'];
        } else {
            $response  = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menghapus data'];
        }

        $delete_stmt->close();
    } else {

        $response  = ['status' => 'error', 'message' => 'Gagal menghapus satu atau lebih file'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();


function extractFilePathsFromHtml($htmlContent) {

    preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $htmlContent, $matches);


    return isset($matches[1]) ? array_map(function ($path) {
        return '../' . $path;
    }, $matches[1]) : [];
}
?>
