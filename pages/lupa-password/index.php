
<head>
    <title>SMA NEGERI 2 TONDANO</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<link rel="stylesheet" href="assets/css/style.css"/>
<?php include("shared/homeLayout.php") ?>

<style>
.reg-sec {
    background-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.5) 100%), url(assets/images/banner-login.jpg);
    background-repeat: no-repeat;
    background-position: right;
    background-size: cover;
    background-attachment: fixed; 
    display: grid;
    align-items: center;
    height: 100%;
    padding-top: 90px;
    position: relative;
    color: white;
    z-index: 1;
    margin: 0 auto;
    padding: 30px;
    overflow:  auto;
}


    #loading-spinner {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      z-index: 9999; 
    }

</style>

<section class="reg-sec" style="width: 100%; margin: 0 auto;">


    <div class="container d-flex justify-content-center align-items-center " style="width: 100%;">
      <div class="col-md-6">
        <!-- <div class="shadow p-3 mb-5 bg-body-tertiary rounded"> -->
            <div class="card shadow " style="border: none;">
            <div class="card-body p-4">
              <h2 class=" text-center ">Reset Password</h2>
             
              <form id="forgetPass" class="needs-validation" novalidate >
                    <div class="row justify-content-center mb-4 ">
                        <div class="col-sm-9 has-validation">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                        <div class="invalid-feedback">
                            Please provide valid email.
                        </div>
                        </div>
                    </div>
                <div class="subbtn d-flex align-items-center justify-content-center ">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Reset Password</button>
                    
                </div>
              </form>
              <div id="loading-spinner" class="d-none d-flex justify-content-center align-items-center">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
          </div>
        <!-- </div> -->
          
        </div>
      </div>
    </div>

</section>

<style>
  .navbar{
    display: none;
  }
  .btn{
    border-radius: 3px;
  }

</style>

<script>
    $(document).ready(function () {
        $("#forgetPass").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $("#loading-spinner").removeClass("d-none");
            $.ajax({
                url : '/controllers/getForgetPass.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response){
                  $("#loading-spinner").addClass("d-none");
                    if(response.status === 'success'){
                        Swal.fire('Sukses', response.message, 'success')
                    } else if(response.status == 'error'){
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                  $("#loading-spinner").addClass("d-none");
                  console.log('Error in AJAX request.');
                }
            });
        });
    });
</script>

<script>
   
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>