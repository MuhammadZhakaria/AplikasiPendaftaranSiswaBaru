<?php 

    session_start();
    if(!$_SESSION['id_user']){
    header("location: Login");
}
    include 'config.php';

    if(isset($_SESSION['Id_calonSiswa'])){
        $id_calonsiswa = $_SESSION['Id_calonSiswa'];

        $sql_select = "SELECT Id_calonSiswa, NamaSekolah, AlamatSekolah, TahunMasuk, TahunKeluar FROM ptb_master_pendidikan WHERE Id_calonSiswa = ?";
        $stmt_select = $connection->prepare($sql_select);
        $stmt_select->bind_param("i", $id_calonsiswa);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
        
            echo json_encode($row);
        }else{
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }

        $stmt_select->close();
    }else{
        echo json_encode(['error' => 'Id_calonSiswa tidak tersedia dalam sesi']);
    }
    $connection->close();
?>