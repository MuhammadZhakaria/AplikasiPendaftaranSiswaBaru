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
                <h4 class="card-title">Create Berita/Pengumuman</h4>
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
                
              </p>
            </div>
            <div class="card-body">
              <div id="toolbar-container"></div>
               <form id="formNews">
                  <div class="row mx-auto">
                    
                  </div>
                    <div id="editor" style="background-color: #F2F4F6;">
                    </div>
                  <div class="input-files mt-2 mb-2 col-md-6" >
                    <label  class="col-mb-6 col-form-label">Sisipkan file(Optional), format files .pdf, .docx</label>
                    <input type="file" class="form-control" id="optional-files" name="optional-files" accept=".pdf, .docx">
                  </div>
                  <textarea id="contentTextarea" name="content" class="form-control d-none" ></textarea>
                
                  <div class="submit-content d-flex justify-content-center  align-items-center ">
                    <button id="publishButton" type="submit" class="btn btn-primary mt-4">Publish</button>
                </div>
              </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/decoupled-document/ckeditor.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

<script>
    function destroyEditor() {
        const existingEditor = document.querySelector('#editor');
        if (existingEditor && existingEditor.ckeditorInstance) {
            existingEditor.ckeditorInstance.destroy();
        }
    }
    function createEditor() {
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: 'postImgContent.php',
                }
            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                editor.model.document.on('change:data', () => {
                    console.log(editor.getData());
                    
                });

                document.querySelector('#editor').ckeditorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
   
    destroyEditor();
    setTimeout(createEditor, 1000);
    $(document).ready(function () {
        $("#formNews").submit(function (event) {
            event.preventDefault();

            var formData = new FormData();
            var optionalFiles = $("#optional-files")[0].files[0];
            formData.append("optional-files", optionalFiles);

            var content = document.querySelector("#editor").ckeditorInstance.getData();
            formData.append("content", content);

            // var content = document.querySelector('#editor').ckeditorInstance.getData();

            $("#contentTextarea").val(content);
            if (!content.trim()) {
                Swal.fire('Error', 'Content cannot be empty', 'error');
                return;
            }

            Swal.fire({
              title: "Konfirmasi",
              text: "Anda yakin ingin mempublish data ini?",
              icon: "question",
              showCancelButton: true,
              confirmButtonText: "Ya",
              cancelButtonText: "Batal"
            }).then((result) => {
              if(result.isConfirmed){
                  $.ajax({
                    url: '/controllers/actionDataNews.php',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire('Success', response.message, 'success');
                        } else if (response.status === 'error') {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function () {
                        console.log("Error in AJAX request.");
                    }
                });
              }
          });
        });
    });
</script>
