<?php 
session_start();
if($_SESSION['id_user'] && $_SESSION['user_level'] === 'admin'){
}else{
    header("location: Error");
    exit;
}


    include 'config.php';

    if(isset($_GET['id_calonSiswa'])){
        $id_calonSiswa = $_GET['id_calonSiswa'];

        $query = "SELECT a.Id_calonSiswa, a.FotoSiswa, b.NamaAyah, b.NamaIbu, b.KontakOrtu, b.NamaWali, b.Hubungan, b.KontakWali,
              c.NamaSekolah, c.AlamatSekolah, c.TahunMasuk, c.TahunKeluar
              FROM ptb_master_datasiswa AS a
              LEFT JOIN ptb_master_datakeluarga AS b ON a.Id_calonSiswa = b.Id_calonSiswa
              LEFT JOIN ptb_master_pendidikan AS c ON a.Id_calonSiswa = c.Id_calonSiswa
              LEFT JOIN ptb_master_berkas AS d ON a.Id_calonSiswa = d.Id_calonSiswa
              WHERE a.Id_calonSiswa = ?";

        $stmtSelect = $connection->prepare($query);
        $stmtSelect->bind_param("i", $id_calonSiswa);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        if($result) {
            $row = $result->fetch_assoc();

            $imageData = $row['FotoSiswa'];
            $base64Image = base64_encode($imageData);

            $response = array(
                'Id_calonSiswa' => $row['Id_calonSiswa'],
                'FotoSiswa' => $base64Image,
                'NamaAyah' => $row['NamaAyah'],
                'NamaIbu' => $row['NamaIbu'],
                'KontakOrtu' => $row['KontakOrtu'],
                'NamaWali' => $row['NamaWali'],
                'Hubungan' => $row['Hubungan'],
                'KontakWali' => $row['KontakWali'],
                'NamaSekolah' => $row['NamaSekolah'],
                'AlamatSekolah' => $row['AlamatSekolah'],
                'TahunMasuk' => $row['TahunMasuk'],
                'TahunKeluar' => $row['TahunKeluar']
            );

            echo json_encode($response);
        }else{
            echo json_encode(array('error' => 'Query error'));
        }
        $connection->close();
    }

?>