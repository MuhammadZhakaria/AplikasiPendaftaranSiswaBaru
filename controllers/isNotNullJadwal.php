<?php 

    include 'config.php';

    $query = "SELECT * FROM ptb_jadwal_pendaftaran";

    $stmt_select = $connection->prepare($query);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if($result->num_rows > 0){

        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        echo json_encode(['status' => 'isExists', 'data' => $data]);
    }else{
        echo json_encode(['status' => 'notExists']);
    }

    $stmt_select->close();
    $connection->close();

?>