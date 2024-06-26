<?php
include("config.php");
require_once '../vendor/autoload.php';
session_start();
if(!$_SESSION['id_user']){
    header("location: Login");
}

if(isset($_SESSION['Id_calonSiswa'])){
    $id_calonSiswa = $_SESSION['Id_calonSiswa'];

    $query = "SELECT a.Id_calonSiswa, a.NamaLengkap, a.NISN, a.JenisKelamin, a.Email, a.TanggalVerifikasi, b.FotoSiswa
              FROM ptb_verifiedpendaftaran As a
              JOIN ptb_master_datasiswa AS b ON a.Id_calonSiswa = b.Id_calonSiswa
              WHERE a.Id_calonSiswa = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id_calonSiswa);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $namaPengguna = $row['NamaLengkap'];
        $nis = $row['NISN'];
        $email = $row['Email'];
        $jenisKelamin = $row['JenisKelamin'];
        $tanggalVerifikasi = $row['TanggalVerifikasi'];
        $fotoSiswa = $row['FotoSiswa'];

        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);

        // Tambahkan halaman
        $pdf->AddPage();

        // Tambahkan border ke seluruh halaman dengan ketebalan 0.5px
        $pdf->SetLineWidth(0.5);
        $pdf->Rect(5, 5, $pdf->GetPageWidth() - 10, $pdf->GetPageHeight() - 10);

        // Tambahkan header dengan logo di sebelah kiri
        $pdf->SetFont('helvetica', 'B', 12);

        // Tambahkan logo di sebelah kiri header
        $logoPath = '../assets/images/web-logo.jpg';
        $pdf->Image($logoPath, 10, 11, 30, 30, 'JPEG');

        // Customized Header
        $pdf->Cell(0, 7, 'SMA NEGERI 2 TONDANO', 0, 1, 'C'); 
        $pdf->Cell(0, 7, 'Tataaran Patar, Kec. Tondano Sel., Kabupaten Minahasa', 0, 1, 'C'); 
        $pdf->Cell(0, 7, 'Tel: (123) 456-7890 | Email: info@sekolahxyz.com', 0, 1, 'C'); 
        $pdf->Ln(5);
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, $pdf->GetY() + 5, $pdf->GetPageWidth() - 10, $pdf->GetY() + 5);
        $pdf->Ln(20);  

        // Tampilkan foto siswa
        $pdf->Image('@' . $fotoSiswa, 150, 60, 40, 60, 'JPEG');

        $labelWidth = 40; 
        $textWidth = 100; 
        $dotWidth = 10; 

        // Tambahkan data pendaftaran
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 5, 'Bukti Pendaftaran ', 0, 1, 'C');
        $pdf->Ln(5);  
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell($labelWidth, 10, 'No Pendaftaran', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $id_calonSiswa, 0, 1);

        $pdf->Cell($labelWidth, 10, 'Nama Pengguna', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $namaPengguna, 0, 1);

        $pdf->Cell($labelWidth, 10, 'NISN', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $nis, 0, 1);

        $pdf->Cell($labelWidth, 10, 'Email', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $email, 0, 1);

        $pdf->Cell($labelWidth, 10, 'Jenis Kelamin', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $jenisKelamin, 0, 1);

        $pdf->Cell($labelWidth, 10, 'Tanggal Finalisasi', 0, 0, 'L');
        $pdf->Cell($dotWidth, 10, ':', 0, 0, 'L');
        $pdf->Cell($textWidth, 10, $tanggalVerifikasi, 0, 1);

        // Tambahkan informasi tambahan
        $pdf->Ln(10); 
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Informasi Tambahan', 0, 1, 'C');
        $pdf->Ln(5); 
        $pdf->SetFont('helvetica', '', 10);
        $pdf->MultiCell(0, 10, 'Siswa tersebut telah berhasil menyelesaikan proses pendaftaran di [Nama Sekolah] dan diterima sebagai siswa baru di kelas [Kelas atau Tingkat Sekolah] untuk tahun ajaran [Tahun Ajaran].', 0, 'L');
        $pdf->Ln(5); 
        $pdf->MultiCell(0, 10, 'Catatan:', 0, 'L');
        $pdf->MultiCell(0, 10, 'Sertifikat ini bersifat resmi dan digunakan sebagai bukti kelulusan pendaftaran. Mohon simpan dan gunakan sertifikat ini untuk keperluan administratif dan pendaftaran lanjutan.', 0, 'L');

        $pdf->Output('bukti_pendaftaran.pdf', 'I');
    }
}

?>
