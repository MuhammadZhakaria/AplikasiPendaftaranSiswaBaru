<?php 
    include 'config.php';

    if(isset($_GET['id_calonSiswa'])){
        $id_calonSiswa = $_GET['id_calonSiswa'];

        $query = "SELECT Id_calonSiswa, Status
                  FROM ptb_verifiedpendaftaran
                  WHERE Id_calonSiswa = $id_calonSiswa";

        $result = $connection->query($query);

        if($result){
            $row = $result->fetch_assoc();

            $response = array(
                'Id_calonSiswa' => $row['Id_calonSiswa'],
                'Status' => $row['Status']
            );

            echo json_encode($response);
        }else{
            echo json_encode(array('error' => 'Query error'));
        }
        $connection->close();
    }
?>