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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<?php 
  include("shared/adminLayout.php") ?>
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
            <h2 class="text-white pb-2 fw-bold">Jadwal Kegiatan</h2>
            <h5 class="text-white op-7 mb-2"></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="page-inner mt--5">
      <div class="row row-card-no-pd">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row card-tools-still-right">
                <h4 class="card-title">Jadwal Kegiatan</h4>
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
                Pengaturan Jadwal Kegiatan 
              </p>
            </div>
            <div class="card-body">
                <form id="formKegiatan">
                    <div class="row mb-3">
                      <label for="jenisKegiatan" class="col-sm-4 col-form-label">Jadwal Kegiatan</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="jenisKegiatan" name="jenisKegiatan" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid asal sekolah.</div>
                      </div>
                    </div>

                    <div class="row ">
                      <label for="tanggalBuka" class="col-sm-4 col-form-label">Tanggal Dibuka</label>
                      <div class="col-sm-6">
                       <input
                          id="datepicker"
                          name="tanggalBuka"
                          id="tanggalBuka"
                          width="276"
                          required
                          autocomplete="off"
                        />
                        <div class="invalid-feedback">Please input a valid asal sekolah.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tanggalTutup" class="col-sm-4 col-form-label">Tanggal Ditutup</label>
                      <div class="col-sm-6">
                       <input
                          id="datepickers"
                          name="tanggalTutup"
                          id="tanggalTutup"
                          width="276"
                          required
                          autocomplete="off"
                        />
                        <div class="invalid-feedback">Please input a valid asal sekolah.</div>
                      </div>
                    </div>

                    <div class="btn-save d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-success mt-2">
                            Save Kegiatan
                        </button>
                    </div>
                </form>

                    <button class="btn btn-primary dropdown-toggle " type="button" data-bs-toggle="collapse" data-bs-target="#collapseItems" aria-expanded="false" aria-controls="collapseExample">
                        Lihat List Kegiatan
                    </button>
                    <div class="collapse" id="collapseItems">
                    <div class="card card-body">
                    <div class="tble-sec">
                        <table id="myTable" class="display table table-striped table-hover" style="width:100%;">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Jadwal Kegiatan</th>
                            <th>Dibuka</th>
                            <th>Ditutup</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </div>
                    </div>
                </div>
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
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

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
    $(document).ready(function () {
        $('#formKegiatan').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                url: '/controllers/actionJadwalKegiatan.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response.status === 'success'){
                        Swal.fire('Success', response.message, 'success').then((result) => {
                            if(result.isConfirmed){
                                window.location.reload();
                            }
                        })
                    }else if(response.status === 'error'){
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(){
                    console.log("Error in AJAX request.");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            'ajax': {
                'url': '/controllers/getJadwalKegiatan.php',
                'dataSrc': ''
            },
            'columns': [
                { 'data': 'Id_Kegiatan' },
                { 'data': 'JenisKegiatan' },
                { 'data': 'TanggalDibuka' },
                { 'data': 'TanggalDitutup' },
                {
                    'data' : null,
                    'render': function(data, type, row){
                        return '<button class="btn btn-sm btn-danger btn-delete ml-1" data-id="' + data.Id_Kegiatan + '"><i class="fas fa-trash"></i> </button>'
                    }
                }
            ],
            'autoWidth': true 
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function() {
            var id_kegiatan = $(this).data('id');
            console.log(id_kegiatan);
            Swal.fire({
                title: "Delete",
                text: "Anda yakin ingin menghapus kegiatan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: '/controllers/deleteJadwalKegiatan.php',
                        method: 'POST',
                        data: {id_kegiatan: id_kegiatan},
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
                            Swal.fire("Error", "Terjadi kesalahan dalam request JSON", "error");
                        }
                    });
                }
            });
        });
    });
</script>