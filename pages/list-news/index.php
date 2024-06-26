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
  include("shared/adminLayout.php") ?>
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
            <h2 class="text-white pb-2 fw-bold">Create News</h2>
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
                <h4 class="card-title">Data Berita/Pengumuman</h4>
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
                Pengaturan data berita dan pengumuman
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
                      <th>Id News</th>
                      <th>Img</th>
                      <th>Date Created</th>
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
    
  </div>
</div>s


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
<style>
      .image_resized{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    img {
        max-width: 200px;
        height: auto;
    }
    p{
      margin-left: 5px;
    }
</style>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
    $("#myTable").DataTable({
        'ajax': {
            'url': '/controllers/getAllDataNews.php',
            'dataSrc': ''
        },
        'columns': [
            { 'data': 'Id_news' },
            {
                'data': 'content_news',
                'render': function (data, type, row) {
                    // Mengambil elemen h2 dan gambar pertama dari konten_news
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(data, 'text/html');
                    var h2Text = doc.querySelector('h2') ? doc.querySelector('h2').innerText : '';
                    var firstImage = doc.querySelector('img');

                    // Membuat div untuk menampilkan h2 dan gambar
                    var result = '<div class="content-container">';
                    result += '<h2>' + h2Text + '</h2>';

                    if (firstImage) {
                        result += '<figure class="image-container">' + firstImage.outerHTML + '</figure>';
                    }

                    result += '</div>';
                    return result;
                }
            },
            { 'data': 'Date_Created' },
            {
                'data': null,
                'render': function (data, type, row) {
                    return '<button class="btn btn-sm btn-danger btn-delete ml-1" data-id="' + data.Id_news + '"><i class="fas fa-trash"></i> </button>';
                }
            }
        ]
    });
});
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btn-delete', function() {
      var id_news = $(this).data('id');

      Swal.fire({
        title: "Delete",
        text: "Anda yakin ingin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/controllers/deleteDataNews.php',
            method: 'POST',
            data: { id_news: id_news},
            dataType: 'json',
            success: function(response) {
              if (response.status === 'success') {
                Swal.fire('Sukses', response.message, 'success').then((result) => {
                  if (result.isConfirmed) {
                    window.location.reload();
                  }
                });
              } else {
                Swal.fire('Error', response.message, 'error');
              }
            },
            error: function(error) {
              console.log("Error in AJAX request.." + JSON.stringify(error));
              Swal.fire("Error", "Terjadi kesalahan dalam request ajax");
            }
          });
        }
      });
    });
  });
</script>