<?php 
    include 'config.php';

   
    $query = "SELECT Id_news, content_news, Date_Created FROM ptb_master_news ORDER BY Date_Created DESC LIMIT 3";

    $stmt_select = $connection->prepare($query);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if($result->num_rows > 0){
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'id_news' => $row['Id_news'],
                'content' => $row['content_news'],
                'date_created' => $row['Date_Created']
            );
        }
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    
    $stmt_select->close();
    $connection->close();
?>
