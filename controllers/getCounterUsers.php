<?php 

    include 'config.php';

    $level = "user";

    $query = "SELECT 
            COUNT(a.user_Id) AS total_users, 
            COUNT(b.user_Id) AS total_users_data, 
            COUNT(CASE WHEN c.Id_calonSiswa IS NOT NULL THEN b.user_Id END) AS total_verified,
            COUNT(CASE WHEN c.Id_calonSiswa IS NULL THEN b.user_Id END) AS total_unverified
            FROM 
                ptb_master_user AS a
            LEFT JOIN 
                ptb_master_datasiswa AS b ON a.user_Id = b.user_Id
            LEFT JOIN 
                ptb_verifiedpendaftaran AS c ON b.Id_calonSiswa = c.Id_calonSiswa
            WHERE 
                a.Level = ? ";

        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $level);
        $stmt->execute();
        $result = $stmt->get_result();

 if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $data = [
        'total_users' => $row['total_users'],
        'total_unverified' => $row['total_unverified'],
        'total_verified' => $row['total_verified']
    ];


        echo json_encode($data);
    }else{
        echo json_encode(['error' => 'Data not found']);
    }

?>