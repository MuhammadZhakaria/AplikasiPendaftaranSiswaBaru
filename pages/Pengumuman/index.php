<?php 
  session_start();
  if(!$_SESSION['id_user'] && !$_SESSION['user_level'] == "admin"){
    echo "<script>window.location.href = '404';</script>";
    exit;
  }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script> 
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
            <h2 class="text-white pb-2 fw-bold">Pengumuman PDF</h2>
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
                <h4 class="card-title">Pengumuman Hasil Pendaftaran</h4>
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
                Upload Hasil Pengumuman
              </p>
            </div>
            <div class="card-body">
                <form id="formPengumuman">
                    <div class="row mb-3">
                      <label for="titlePengumuman" class="col-sm-4 col-form-label">Title</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="titlePengumuman" name="titlePengumuman" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid Title.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label">Upload File, format files .pdf, .docx</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control" id="filePengumuman" name="filePengumuman" accept=".pdf, .docx" required>
                        <div class="invalid-feedback">Please input a valid file.</div>
                      </div>
                    </div>

                    <div class="btn-save d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-success mt-2">
                            Upload Pengumuman
                        </button>
                    </div>
                </form>
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
  $(document).ready(function () {
    $("#formPengumuman").submit(function (event) {
      event.preventDefault();

      var title = $("#titlePengumuman").val();

      var formData = new FormData();
      var filePengumuman = $("#filePengumuman")[0].files[0];
      formData.append("filePengumuman", filePengumuman);
      formData.append("titlePengumuman", title);

      Swal.fire({
        title: "Konfirmasi",
        text: "Upload Pengumuman ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        if(result.isConfirmed){
          $.ajax({
            url: '/controllers/actionPengPDF.php',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
              if(response.status === 'success'){
                Swal.fire('Success', response.message, 'success');
              }else if(response.status === 'error'){
                Swal.fire('Error', response.message, 'error');
              }
            },
            error: function(){
              console.log("ERROR IN AJAX REQUEST");
            }
          });
        }
      });
    });
  });
</script>