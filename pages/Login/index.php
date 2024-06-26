<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SMA NEGERI 2 TONDANO</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </head>
<section class="vh-100">

  <div class="container mt-2 h-100">
      <a class="navbar-brand" href="Home">
          <img src="assets/images/web-logo.png" alt="Logo" class="logo-img">
          SMA NEGERI 2 TONDANO
      </a>
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="assets/images/exm.jpg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
          <div class="col-md-12 imglogo">
            <img src="assets/images/web-logo.png" alt="img-logo" style="width: 120; height:120px; margin: 0 auto;"/>
          </div>
          <h5 class="card-title mt-2">Portal Pendaftaran Siswa</h5>
          <p class="card-text">Login untuk mengisi form pendaftaran.</p>
          
          <form id="loginForm" class="needs-validation" novalidate>
          <!-- Email input -->
          <div class="form-outline mb-4 has-validation ">
            <label class="form-label" for="Email">Email address</label>
            <input type="email" id="Email" name="Email" class="form-control form-control-lg" required autocomplete="off" />
            <div class="invalid-feedback">
              Please provide valid email.
            </div>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="Password">Password</label>
            <input type="password" id="Password" name="Password" class="form-control form-control-lg" required />
            <div class="invalid-feedback">
              Please provide valid password.
            </div>
          </div>

          <div class="mb-4 d-flex justify-content-center align-items-center">
            <p style="margin-right: 50px;">Belum punya akun?<a href="Daftar-Akun" style="text-decoration: none;"> Daftar disini</a></p>
            <p><a href="lupa-password" style="text-decoration: none;">Lupa Password?</a></p>
          </div>

          <!-- Submit button -->
          <div class="ned-cen d-flex justify-content-center align-items-center">
            <button id="btn-login" type="submit" class="btn btn-primary btn-md btn-block mb-2">Sign in</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
<script src="lib/scripts/reqLgn.js"></script>

<style>
  .btn{
    border-radius: 3px;
  }

  .form-control{
    border-radius: 4px;
  }

    .navbar-brand img{
        width: 50px;
        height: 50px;
    }
    .imglogo{
      display: flex;
      justify-content: center;
    }
</style>
