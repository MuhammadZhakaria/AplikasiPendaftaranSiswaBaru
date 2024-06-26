<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php include 'shared/homeLayout.php'; ?>
<style>
.reg-sec {
    background-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.5) 100%), url(../assets/images/banner-login.jpg);
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
<section class="reg-sec" style="width: 100%; margin: 0 auto">
  <a class="navbar-brand mb-2" href="Home">
    <img src="../assets/images/web-logo.png" alt="Logo" class="logo-img" />
    SMA NEGERI 2 TONDANO
  </a>
  <div class="container" style="width: 100%">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-7">
        <div class="card shadow" style="border: none">
          <div class="card-body p-5">
            <h2 class="text-center mb-5">Verifikasi Akun</h2>

            <form id="verifyAkun" class="needs-validation" novalidate>
              <div class="row mb-3 justify-content-center">
                <div class="col-sm-9 has-validation">
                  <label class="col-sm-5 col-form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    readonly
                  />
                  <div class="invalid-feedback">
                    Please provide valid email.
                  </div>
                </div>
              </div>
              <div class="row mb-3 justify-content-center">
                <div class="col-sm-9 has-validation">
                  <label class="col-sm-6 col-form-label">Code Verifikasi</label>
                  <input
                    type="text"
                    class="form-control"
                    id="verificationCode"
                    name="verificationCode"
                    required
                    autocomplete="off"
                  />
                  <div class="invalid-feedback">Invalid Verification Code.</div>
                </div>
              </div>
              <div
                class="subbtn d-flex align-items-center justify-content-center"
              >
                <button type="submit" id="btnSubmit" class="btn btn-primary">
                  Verifikasi
                </button>
              </div>
            </form>
            <div
                id="loading-spinner"
                class="d-none d-flex justify-content-center align-items-center"
              >
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="mt-4">
              <p style="margin-right: 50px">
                Resend Code?<a href="" id="resendCode" style="text-decoration: none"> Resend</a>
              </p>
            </div>
          </div>
        </div>
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
    $("#verifyAkun").submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        url: '/controllers/verificationEmailAction.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {
          if (response.status == 'success') {
              Swal.fire('Sukses', response.message, 'success').then((result) => {
              if (result.isConfirmed) {
                window.location.href = '../Login';
              }
            });
          } else if(response.status == 'error'){
            Swal.fire('Error', response.message, 'error');
          }
        },
        error: function () {
          console.log('Error in AJAX request.');
        },
      });
    });
  });
</script>

<script>
  var urlParams = new URLSearchParams(window.location.search);
  var email = urlParams.get("email");
  document.getElementById("email").value = email;
</script>

<script>
  $(document).ready(function () {
    $("#resendCode").click(function (e) {
      e.preventDefault();

      const resCode = $("#email").val();
      $("#loading-spinner").removeClass("d-none");
      $.ajax({
        url: '/Controllers/resendCodeAction.php',
        method: 'POST',
        dataType: "json",
        data: {email: resCode},
        success: function(response){
          $("#loading-spinner").addClass("d-none");
          if(response.status === 'success'){
            Swal.fire("Sukses", response.message, "success");
          }
        },
        error: function(){
          $("#loading-spinner").addClass("d-none");
          console.log("ERROR IN AJAX REQUEST");
        }
      });
    });
  });
</script>