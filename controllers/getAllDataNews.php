<?php 

    include 'config.php';

    $query = "SELECT Id_news, content_news, Date_Created FROM ptb_master_news";

    $result = $connection->query($query);

    $data = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }

    echo json_encode($data);
    $connection->close();

?>