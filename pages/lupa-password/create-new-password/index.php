
<head>
    <title>Portal Pendaftaran: SMA 2 TONDANo</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<link rel="stylesheet" href="assets/css/style.css"/>
<?php include("shared/homeLayout.php") ?>

<style>
.reg-sec {
    background-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.5) 100%), url(../../assets/images/banner-login.jpg);
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
              <form id="newPassword" class="needs-validation" novalidate >
                    <div class="row justify-content-center mb-4 d-none">
                        <div class="col-sm-9 has-validation">
                        <label class="col-sm-4 col-form-label">Token</label>
                        <input type="text" class="form-control" id="token" name="token" required autocomplete="off">
                        <div class="invalid-feedback">
                            Please provide valid email.
                        </div>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center  ">
                        <div class="col-sm-9 has-validation">
                        <label class="col-sm-6 col-form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                            <div class="invalid-feedback">
                                Please provide valid password.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center  ">
                        <div class="col-sm-9 has-validation">
                        <label class="col-sm-6 col-form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required autocomplete="off">
                            <div class="invalid-feedback">
                                Password tidak sesuai.
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
          <div class=" d-flex justify-content-around mt-4">
            <!-- <p style="margin-right: 50px;">Already Have Account?<a href="Login" style="text-decoration: none;"> Login</a></p> -->
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
    var urlParams = new URLSearchParams(window.location.search);
    var token = urlParams.get("token");

    document.getElementById("token").value = token;
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

<script>
    $(document).ready(function () {
        $('#newPassword').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            var password = $("#password").val();
            var confirmasiPassword = $("#confirmPassword").val();

            if(password !== confirmasiPassword){
                Swal.fire('Error', 'Password do not match', 'error');
                return;
            }

            $.ajax({
                url: '/controllers/actionResetPassword.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response){
                    if(response.status === 'success'){
                        Swal.fire('Sukses', response.message, 'success').then((result) => {
                            if(result.isConfirmed){
                                window.location.href = '../../Login';
                            }
                        })
                    }else if(response.status === 'error'){
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(){
                    console.log('Error in AJAX request');
                }
            });
        });
    });
</script>