<?php


session_start();



include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_SESSION['id_user'])) {
        $user_Id = $_SESSION['id_user'];
    } else {
        
        $response = ['status' => 'error', 'message' => 'user_Id tidak ditemukan dalam sesi.'];
    }

    
    if (isset($user_Id)) {
        $nmaLengkap = $_POST["nmaLengkap"];
        $email = $_POST["email"];
        $nisn = $_POST['nisn'];
        $jenisKelamin = $_POST["jenisKelamin"];
        $tempatLahir = $_POST["tempatLahir"];
        $tanggalLahir = $_POST["tanggalLahir"];
        $noHP = $_POST["noHP"];
        $agama = $_POST["agama"];
        $alamat = $_POST["alamat"];
        $province = $_POST["province"];
        $kabkota = $_POST["regency"];
        $kecamatan = $_POST["district"];
        $kelurahan = $_POST["village"];

        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $imgData = file_get_contents($_FILES['image']['tmp_name']);
                $fileName = $_FILES['image']['name'];
            } else {
                echo "Gambar tidak diunggah";
                exit();
            }
        }

        $updateQuery = "SET @num := 0; UPDATE ptb_master_datasiswa SET Id_calonSiswa = @num := (@num + 1);";
        if ($connection->multi_query($updateQuery)) {
            do {

                if ($result = $connection->store_result()) {
                    $result->free();
                }
            } while ($connection->more_results() && $connection->next_result());
        } else {
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam query UPDATE: ' . $connection->error];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $checkSql = "SELECT Id_calonSiswa FROM ptb_master_datasiswa WHERE user_Id = ?";
        $checkStmt = $connection->prepare($checkSql);
        $checkStmt->bind_param("i", $user_Id);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {

            $updateSql = "UPDATE ptb_master_datasiswa SET NamaLengkap = ?, Email = ?, NISN = ?, Jeniskelamin = ?, TempatLahir = ?, TanggalLahir = ?, NoHP = ?, Agama = ?, Alamat = ?, Provinsi = ?, KabKota = ?, Kecamatan = ?, Kelurahan = ?, FotoSiswa = ?, FileNames = ? WHERE user_Id = ?";
            $stmt = $connection->prepare($updateSql);
            $stmt->bind_param("ssissssssssssssi", $nmaLengkap, $email, $nisn, $jenisKelamin, $tempatLahir, $tanggalLahir, $noHP, $agama, $alamat, $province, $kabkota, $kecamatan, $kelurahan, $imgData, $fileName, $user_Id);
        } else {
            $alterQuery = "ALTER TABLE ptb_master_datasiswa AUTO_INCREMENT = 1;";
            $connection->query($alterQuery);

            $insertSql = "INSERT INTO ptb_master_datasiswa (user_Id, NamaLengkap, Email, NISN, Jeniskelamin, TempatLahir, TanggalLahir, NoHP, Agama, Alamat, Provinsi, KabKota, Kecamatan, Kelurahan, FotoSiswa, FileNames) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($insertSql);
            $stmt->bind_param("ississssssssssss", $user_Id, $nmaLengkap, $email, $nisn, $jenisKelamin, $tempatLahir, $tanggalLahir, $noHP, $agama, $alamat, $province, $kabkota, $kecamatan, $kelurahan, $imgData, $fileName);
        }

        if ($stmt->execute()) {
            $calonSiswaId = mysqli_insert_id($connection);
            $_SESSION['Id_calonSiswa'] = $calonSiswaId;

            $response = ['status' => 'success', 'message' => 'Data berhasil disimpan'];
        } else {
            echo "Error: " . $stmt->error;
            $response = ['status' => 'error', 'message' => 'Terjadi kesalahan dalam menyimpan data.'];
        }

        $stmt->close();
        $checkStmt->close();
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}

$connection->close();
?>
