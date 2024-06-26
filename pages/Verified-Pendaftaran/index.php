<?php 
  session_start();
  if(!$_SESSION['id_user'] && !$_SESSION['user_level'] == "admin"){
    echo "<script>window.location.href = '404';</script>";
    exit;
  }
  

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
<link rel="stylesheet" href="assets/css/additionalStylePS.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>


<!-- TCPDF JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>

<?php 
  include("shared/adminLayout.php");

?>


<style>

  #shwImgModal{
  max-width: 100%;
  height: 150px;
  }


  #loading-spinner {
    position: fixed;
    display: flex;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8); 
    z-index: 9999; 
  }


  
  /* .desv p{
    line-height: 15px;
  } */
</style>


<div class="main-panel">
  <div class="content">
    <div class="panel-header bg-primary-gradient">
      <!-- Header page main-->
      <div class="page-inner py-5">
        <div
          class="d-flex align-items-left align-items-md-center flex-column flex-md-row"
        >
          <div>
            <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
            <h5 class="text-white op-7 mb-2"></h5>
          </div>
        </div>
      </div>
    </div>

    <div id="loading-spinner" class="d-none justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <div class="page-inner mt--5">
      <div class="row row-card-no-pd">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row card-tools-still-right">
                <h4 class="card-title">Data Verified</h4>
                <div class="card-tools">
                  <button class="btn btn-icon btn-link btn-primary btn-xs">
                    <span class="fa fa-angle-down"></span>
                  </button>
                  <button
                    class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"
                  >
                    <span class="fa fa-sync-alt"></span>
                  </button>
                  <button class="btn btn-icon btn-link btn-primary btn-xs">
                    <span class="fa fa-times"></span>
                  </button>
                </div>
              </div>
              <p class="card-category">
                Data calon siswa yang sudah melakukan verifikasi
              </p>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="myTable"
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NISN</th>
                      <th>Nama Lengkap</th>
                      <th>Email</th>
                      <th>Jenis Kelamin</th>
                      <th>No Hp</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat</th>
                      <th>Tanggal Verifikasi</th>
                      <th>Status</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-mb-3">
            <img
              class="image-area img-fluid rounded mx-auto d-block"
              id="shwImgModal"
              src="src/images/upldImage.jpg"
            />
          </div>

          <div class="row mb-2 ml-1">
                    <label for="id_calonSiswa" class="col-sm-1 col-form-label">ID</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="id_calonSiswa" readonly>
                    </div>
                  </div>
          <!-- <h2>Data Keluarga</h2> -->
          <div class="accordion accordion-flush mt-2" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Data Keluarga
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Nama Ayah</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nmaAyah" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Nama Ibu</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nmaIbu" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Kontak Orang Tua</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="kontakOrtu" readonly>
                    </div>
                  </div>

                                    <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Nama Wali</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nmaWali" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Hubungan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="hubungan" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="namaWali" class="col-sm-4 col-form-label">Kontak Wali</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="kontakWali" readonly>
                    </div>
                  </div>


                </div>
              </div>
            </div>


            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Data Pendidikan
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  
                  <div class="row mb-2">
                    <label for="nmaSekolah" class="col-sm-4 col-form-label">Nama Sekolah</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nmaSekolah" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="almtSekolah" class="col-sm-4 col-form-label">Alamat Sekolah</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="almtSekolah" readonly>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="thunMasuk" class="col-sm-4 col-form-label">Tahun</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="thunMasuk" readonly>
                    </div>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="thunKeluar" readonly>
                    </div>
                  </div>



                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Data Berkas
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                  <div class="row mb-2">
                    <label for="fileIjazah" class="col-sm-4 col-form-label">File Ijazah</label>
                    <div class="col-sm-6">
                        <a class="btn btn-primary text-light" onclick="showPdfData('FileIjazah')">Lihat Ijazah</a>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <label for="fileRaport" class="col-sm-4 col-form-label">File Raport</label>
                    <div class="col-sm-6">
                        <a class="btn btn-primary text-light" onclick="showPdfData('FileRaport')">Lihat Raport</a>
                    </div>
                  </div>
                   
                  <div class="row mb-2">
                      <label for="kartuKeluarga" class="col-sm-4 col-form-label">Kartu Keluarga</label>
                      <div class="col-sm-6">
                          <a class="btn btn-primary text-light" onclick="showPdfData('KartuKeluarga')">Lihat Kartu Keluarga</a>
                      </div>
                  </div>

                  <div class="row mb-2">
                      <label for="akteLahir" class="col-sm-4 col-form-label">Akte Lahir</label>
                      <div class="col-sm-6">
                          <a class="btn btn-primary text-light" onclick="showPdfData('AkteLahir')">Lihat Akte Kelahiran</a>
                      </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
         
        <div class="row mb-2 ml-1">
          <label for="edtid_calonSiswa" class="col-sm-4 col-form-label">ID</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="edtid_calonSiswa" readonly>
            </div>
        </div>

        <div class="row mb-2 ml-1">
          <label for="status" class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-6"> 
                <select name="status" class="form-select">
                  <option>Dalam Proses Seleksi</option>
                  <option>LULUS</option>
                  <option>TIDAK LULUS</option>
                </select>
            </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btnEditSave">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
      <div class="container-fluid">
        <nav class="pull-left">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="#"> Help </a>
            </li>
          </ul>
        </nav>
      </div>
    </footer>
  </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

//Export data
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<script>
$(document).ready(function () {
  $("#myTable").DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copy',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 8]
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 8]
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 8]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 8],
        },
        customize: function (doc) {
          // Tambahkan header teks di sini
          doc.content.unshift({
            text: 'HASIL PENGUMUMAN SELEKSI PENDAFTARAN SMA 2 NEGERI TONDANO',
            style: 'header'
          });

          // Atur gaya header
          doc.styles.header = {
            fontSize: 18,
            bold: true,
            alignment: 'center'
          };

          // Atur margin
          doc.pageMargins = [20, 60, 20, 30];
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [0, 1, 2, 3, 5, 8]
        }
      }
    ],
    'ajax': {
      'url': '/controllers/getVerifiedDataFull.php',
      'dataSrc': ''
    },
    'columns': [
      {'data': 'Id_calonSiswa'},
      {'data': 'NISN'},
      {'data': 'NamaLengkap'},
      {'data': 'Email'},
      {'data': 'JenisKelamin'},
      {'data': 'NoHp'},
      {'data': 'TanggalLahir'},
      {'data': 'Alamat'},
      {'data': 'TanggalVerifikasi'},
      {
        'data': 'Status',
        'render': function (data, type, row) {
          if (data === "LULUS") {
            return '<span class="badge text-bg-success">LULUS</span>';
          } else if (data === "TIDAK LULUS") {
            return '<span class="badge text-bg-danger">TIDAK LULUS</span>';
          } else if (data === 'Dalam Proses Seleksi') {
            return '<span class="badge text-bg-info">Dalam Proses Seleksi</span>';
          } else {
            return data;
          }
        }
      },
      {
        'data': null,
        'render': function (data, type, row) {
          return '<div class="btn-group" role="group" aria-label="Tombol Aksi">' +
            '<button class="btn btn-sm btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' + data.Id_calonSiswa + '"><i class="fas fa-eye"></i> </button>' +
            '<button class="btn btn-sm btn-warning btn-edit ml-1" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' + data.Id_calonSiswa + '"><i class="fas fa-edit"></i> </button>' +
            '<button class="btn btn-sm btn-danger btn-delete ml-1" data-id="' + data.Id_calonSiswa + '"><i class="fas fa-trash"></i> </button>' +
            '</div>';
        }
      }
    ]
  });
});

</script>

<script>
  $(document).ready(function () {
      $(document).on('click', '.btn-details', function() {
          var id_calonSiswa = $(this).data('id');

          $.ajax({
            url: '/controllers/getDetailsData.php',
            method: 'GET',
            data: {id_calonSiswa: id_calonSiswa},
            dataType: 'json',
            success: function(reseponse){
              $("#shwImgModal").attr("src", "data:image/jpeg;base64," + reseponse.FotoSiswa);
              $('#id_calonSiswa').val(reseponse.Id_calonSiswa);
              $('#nmaAyah').val(reseponse.NamaAyah);
              $('#nmaIbu').val(reseponse.NamaIbu);
              $('#kontakOrtu').val(reseponse.KontakOrtu);
              $('#nmaWali').val(reseponse.NamaWali);
              $('#hubungan').val(reseponse.Hubungan);
              $('#kontakWali').val(reseponse.KontakWali);

              $('#nmaSekolah').val(reseponse.NamaSekolah);
              $('#almtSekolah').val(reseponse.AlamatSekolah);
              $('#thunMasuk').val(reseponse.TahunMasuk);
              $('#thunKeluar').val(reseponse.TahunKeluar);
            },
            error: function(xhr, status, error){
              console.error(error);
            }
        });
      });
  });
</script>

<script>
  function tampilkanPDF() {
    var id_calonSiswa = $('#id_calonSiswa').val();

    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "/controllers/getDetailPendidikanPdf.php?id_calonSiswa=" + id_calonSiswa,
      true
    );
    xhr.responseType = "blob";

    xhr.onload = function () {
      if (xhr.status === 200) {
        var blob = new Blob([xhr.response], { type: "application/pdf" });
        var url = window.URL.createObjectURL(blob);

        // Buka PDF di tab baru
        var newTab = window.open();
        newTab.document.write("<html><style>*{margin:0px;}</style> <body><embed src='" + url + "' type='application/pdf' width='100%' height='100%' ></embed></body></html>");
      }
    };

    xhr.send();
  }
</script>

<script>
function showPdfData(jenisFile) {
    var id_calonSiswa = $('#id_calonSiswa').val();

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/controllers/getDataBerkas.php?id_calonSiswa=" + id_calonSiswa + "&file=" + jenisFile, true);
    xhr.responseType = "blob";

    xhr.onload = function() {
        if (xhr.status === 200) {
            var blob = new Blob([xhr.response], { type: "application/pdf" });
            var url = window.URL.createObjectURL(blob);

            var newTab = window.open();
            if (newTab) {
                newTab.document.write("<html><style>*{margin:0;}</style><body><embed src='" + url + "' type='application/pdf' width='100%' height='100%'></embed></body></html>");
            } else {
                alert('Please allow popups for this website');
            }
        } else {
            console.error("Failed to fetch the PDF. Status: " + xhr.status);
        }
    };

    xhr.onerror = function() {
        console.error("An error occurred during the request.");
    };

    xhr.send();
}


</script>


<script>
  $(document).on("click", ".btn-edit", function () {
  var id_calonSiswa = $(this).data("id");
  // Aktifkan modal edit
  $("#editModal").modal("show");
});

</script>

<script>
  $(document).ready(function () {
    $(document).on('click', '.btn-edit', function() {
      var id_calonSiswa = $(this).data('id');

      $.ajax({
        url: '/controllers/getStatusInfo.php',
        method: 'GET',
        data: {id_calonSiswa: id_calonSiswa},
        dataType: 'json',
        success: function(response){
          $('#edtid_calonSiswa').val(response.Id_calonSiswa);
          $('#status').val(response.Status);
        },
        error: function(xhr, status, error){
          console.error(error);
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function () {
    $("#btnEditSave").on('click', function() {
      var id_calonSiswa = $('#edtid_calonSiswa').val();
      var selectedStatus = $('select[name="status"]').val();
      
      Swal.fire({
        title: "Konfirmasi",
        text: "Anda yakin ingin mengupdate status ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        if(result.isConfirmed){
          $("#loading-spinner").removeClass("d-none");
          $.ajax({
            
            url: '/controllers/updateStatusSiswa.php',
            method: 'POST',
            data: {id_calonSiswa: id_calonSiswa, status: selectedStatus},
            dataType: 'json',
            success: function(response){
              $("#loading-spinner").addClass("d-none");
              if(response.status === 'success'){
                Swal.fire('Sukses', response.message, 'success').then((result) => {
                  if(result.isConfirmed){
                    window.location.reload();
                  }
                });
              }else{
                Swal.fire('Error', response.message, 'error');
              }
            },
            error: function(error){
              console.log("Error in AJAX request.." + JSON.stringify(error));
              Swal.fire("Error", "Terjadi kesalahan dalam perintah AJAX");
            }
          });
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function () {
    $(document).on('click', '.btn-delete', function() {
      var id_calonSiswa = $(this).data('id');

      Swal.fire({
        title: "Delete",
        text: "Anda yakin ingin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        
        if(result.isConfirmed){
          $.ajax({
            url: '/controllers/deleteVerifiedData.php',
            method: 'POST',
            data: {id_calonSiswa: id_calonSiswa},
            dataType: 'json',
            success: function(response){
              if(response.status === 'success'){
                Swal.fire('Sukses', response.message, 'success').then((result) => {
                  if(result.isConfirmed){
                    window.location.reload();
                  }
                });
              }else{
                Swal.fire('Error', response.message, 'error');
              }
            },
            error: function(error){
              console.log("Error in AJAX request.." + JSON.stringify(error));
              Swal.fire("Error", "Terjadi kesalahan dalam request ajax");
            }
          }); 
        }
      });
    });
  });
</script>

