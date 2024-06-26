<?php

    include 'config.php';

    $query = "SELECT * FROM ptb_jadwal_kegiatan";
    $stmt = $connection->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();


    $data = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }
    echo json_encode($data);
    $stmt->close();
    $connection->close();

?>