<?php
include 'config.php';

// Get id_news from the URL parameter
$id_news = isset($_GET['id_news']) ? intval($_GET['id_news']) : 0;

if ($id_news > 0) {
    $query = "SELECT content_news FROM ptb_master_news WHERE Id_news = ?";

    $stmt_select = $connection->prepare($query);

    if ($stmt_select) {
        $stmt_select->bind_param("i", $id_news);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode(['status' => 'success', 'content' => $row['content_news']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data not found']);
            }
            $result->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error in executing the query: ' . $stmt_select->error]);
        }

        $stmt_select->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in preparing the query: ' . $connection->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid id_news parameter']);
}

$connection->close();
?>
