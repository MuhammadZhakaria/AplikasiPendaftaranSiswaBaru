<?php
include "config.php";

$query_select = "SELECT TitlePengumuman, FilePengumuman FROM ptb_pengumuman ORDER BY Id_Pengumuman DESC LIMIT 1";

$result = $connection->query($query_select);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $titlePengumuman = $row['TitlePengumuman'];
    $filePengumuman = $row['FilePengumuman'];

    if (isset($_GET['download']) && $_GET['download'] == 'true') {
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=hasil_pengumuman.pdf");
        echo $filePengumuman;
    } else {
        $response = ['status' => 'success', 'title' => $titlePengumuman];
        echo json_encode($response);
    }
} else {
    $response = ['status' => 'error', 'message' => 'Data not found'];
    echo json_encode($response);
}

$connection->close();
?>