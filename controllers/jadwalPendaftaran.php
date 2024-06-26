<?php 

    include 'config.php';

    $query = "SELECT TanggalBuka, TanggalTutup FROM ptb_jadwal_pendaftaran ";

    $result = $connection->query($query);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $tanggalBuka = new DateTime($row['TanggalBuka']);
        $tanggalTutup = new DateTime($row['TanggalTutup']);

        $currentTime = new DateTime();

        $response = array();

        if($currentTime >= $tanggalBuka && $currentTime <= $tanggalTutup){
            $response['status'] = 'active';
            $response['TanggalBuka'] = $tanggalBuka->format('Y-m-d');
            $response['TanggalTutup'] = $tanggalTutup->format('Y-m-d');
        }else{
            $response['status'] = 'inactive';
        }
    
      $connection->close();
    }else{
        $response['error'] = 'Jadwal tidak ditemukan';
    }

    header('Content-Type: application/json');
    echo json_encode($response);

?>