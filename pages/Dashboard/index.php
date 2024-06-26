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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>


<?php 
  include("shared/adminLayout.php");

?>

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
    <div class="page-inner mt--5">
      <div class="row">
        <div class="col-md-6">
          <div class="card full-height">
            <div class="card-body">
              <div class="card-title">Overall statistics</div>
              <div class="card-category">
                Daily informasi dari sistem ini
              </div>
              <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                <div class="col-sm-3 text-center">
                  <div id="circles-1"></div>
                  <h6 class="fw-bold mt-3 mb-0">Total Users</h6>
                  
                  <div class="ttl-users mt-5">
                    <h2 class="text-primary" id="countUserUsers"></h2>
                    <p>Users</p>
                  </div>

                </div>
                <div class="px-2 pb-2 pb-md-0 text-center">
                  <div id="circles-2"></div>
                  <h6 class="fw-bold mt-3 mb-0">Verified</h6>

                         <div class="ttl-users mt-5">
                    <h2 class="text-success" id="countUsersVerified"></h2>
                    <p>Users</p>
                  </div>

                </div>
                <div class="px-2 pb-2 pb-md-0 text-center">
                  <div id="circles-3"></div>
                  <h6 class="fw-bold mt-3 mb-0">Unverified</h6>

                    <div class="ttl-users mt-5">
                    <h2 class="text-danger" id="countUsersUnVerified"></h2>
                    <p>Users</p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="card full-height ">
            <div class="card-title mt-3 ml-3">Atur Jadwal Pendaftaran</div>
            <div class="card-body d-flex justify-content-center align-items-center ">
            
              <div class="row py-3">
                <form
                  method="post"
                  class="needs-validation"
                  novalidate
                  id="jadwalSubmit"
                >
                  <div class="row mx-auto ">
                    <div class="has-validation">
                      <label for="date">Tanggal Buka Pendaftaran</label>
                      <div class="inputDate">
                        <input
                          id="datepicker"
                          name="tanggalBuka"
                          id="tanggalBuka"
                          width="276"
                          required
                        />
                        <div class="invalid-feedback">
                          Please select a valid email.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mx-auto">
                    <div class="has-validation">
                      <label for="date">Tanggal Tutup Pendaftaran</label>
                      <div class="inputDate">
                        <input
                          id="datepickers"
                          name="tanggalTutup"
                          id="tanggalTutup"
                          width="276"
                          required
                        />
                      </div>
                      <div class="invalid-feedback">
                        Please select a valid email.
                      </div>
                    </div>
                  </div>
                  <div class="btnC d-flex justify-content-center">
                    <button
                      type="submit"
                      class="btn btn-success mt-2"
                      style="width: 100px"
                      id="saveButton"
                    >
                      Save
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" id="lihatJadwal" class="btn btn-primary mt-2 ml-2">
                      Lihat Jadwal
                    </button>
                  </div>
                </form>
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Jadwal Pendaftaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h5>Data jadwal tidak boleh lebih dari satu</h5>

                        <div class="tbl">
                          <table
                            id="tbJadwal"
                            class="display table table-striped table-hover"
                            style="width: 100%";
                          >
                            <thead>
                              <tr>
                                <th>Id_Jadwal</th>
                                <th>Tanggal Buka</th>
                                <th>Tanggal Tutup</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-card-no-pd">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row card-tools-still-right">
                <h4 class="card-title">Data finalisasi pendaftaran</h4>
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
                      <th>NISN</th>
                      <th>Nama Lengkap</th>
                      <th>Jenis Kelamin</th>
                      <th>Email</th>
                      <th>NoHp</th>
                      <th>Tanggal Verifikasi</th>
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
</div>
</body>
</html>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css"/>



  <script>
    $(document).ready(function () {
      $("#jadwalSubmit").submit(function (event) {
        event.preventDefault();

        var tanggalBuka = $("#datepicker").val();
        var tanggalTutup = $("#datepickers").val();

        if(tanggalBuka === '' || tanggalTutup === ''){
          Swal.fire({
            title: "Error",
            text: "Data form tidak boleh kosong",
            icon: "error",
            confirmButtonText: "Ok"
          });
          return;
        }

        Swal.fire({
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin membuat jadwal ini?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Ya",
          cancelButtonText: "Batal"
        }).then((result) => {
          if(result.isConfirmed){
            var formData = new FormData(this);
            $.ajax({
              url: "/controllers/aturJadwalAction.php",
              type: "POST",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function(response){
                if(response.status === 'success'){
                  Swal.fire('Success', response.message, 'success').then((result) => {
                    window.location.reload();
                  });
                }else if(response.status === 'error'){
                  Swal.fire('Error', response.message, 'error');
                }
              },
              error: function() {
                console.log("Error in AJAX request");
              }
            });
          }
        });
      });
    });
  </script>

  <script>
    $("#datepicker").datepicker({
      uiLibrary: "bootstrap5",
      format: "yyyy-mm-dd",
    });
    $("#datepickers").datepicker({
      uiLibrary: "bootstrap5",
      format: "yyyy-mm-dd",
    });

  
    (() => {
      "use strict";

    
      const forms = document.querySelectorAll(".needs-validation");

      Array.from(forms).forEach((form) => {
        form.addEventListener(
          "submit",
          (event) => {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add("was-validated");
          },
          false
        );
      });
    })();
  </script>

<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      'ajax': {
          'url' : '/controllers/getVerifiedData.php',
          'dataSrc': ''
      },
       'columns':[
            {'data': 'NISN'},
            {'data': 'NamaLengkap'},
            {'data': 'JenisKelamin'},
            {'data': 'Email'},
            {'data': 'NoHp'},
            {'data': 'TanggalVerifikasi'}
       ]
    })
  })
</script>


<script>
  $(document).ready(function () {
    $.ajax({
      url: '/controllers/getCounterUsers.php',
      type: 'GET',
      dataType: 'json',
      success: function(data){
        $('#countUserUsers').text(data.total_users);
        $('#countUsersVerified').text(data.total_verified);
        $('#countUsersUnVerified').text(data.total_unverified);
      },
      error: function(error){
        console.log(error);
      }
    })
  })
</script>

<script>
  $(document).ready(function () {
    $.ajax({
      url: '/controllers/isNotNullJadwal.php',
      method: 'GET',
      dataType: 'json',
      success: function(response){
        if(response.status === 'isExists'){
          $('#saveButton').prop('disabled', true);
        }
      }
    });
  })
</script>

<script>
  $(document).ready(function() {
    $('#tbJadwal').DataTable({
      'ajax': {
        'url' : '/controllers/isNotNullJadwal.php',
        'dataSrc': 'data'
      },
      'columns':[
        {'data' : 'Id_jadwal'},
        {'data' : 'TanggalBuka'},
        {'data' : 'TanggalTutup'},
        {
          'data': null,
          'render': function(data, type, row){
            return '<button class="btn btn-sm btn-danger btn-delete" data-id="'+ data.Id_jadwal +'"><i class="fas fa-trash"></i></button>';
          }
        }
      ]
    });
  });
</script>

<script>
  $(document).ready(function () {
    $(document).on('click', '.btn-delete', function () {
      var id_jadwal = $(this).data('id');

      Swal.fire({
        title: "Delete",
        text: "Anda yakin ingin menghapus jadwal ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        if(result.isConfirmed){
          $.ajax({
            url: '/controllers/deleteJadwal.php',
            method: 'POST',
            data: {id_jadwal: id_jadwal},
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
              console.log("Error in AJAX request..." + JSON.stringify(error));
              Swal.fire("Error", "Terjadi kesalahan dalam request AJAX");
            }
          });
        }
      });
    });
  });
</script>



