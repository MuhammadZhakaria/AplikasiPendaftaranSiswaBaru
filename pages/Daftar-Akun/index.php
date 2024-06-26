<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<link rel="stylesheet" href="assets/css/style.css"/>
<?php include("shared/homeLayout.php") ?>

<style>

</style>

<section class="reg-sec" style="width: 100%; margin: 0 auto">
  <a class="navbar-brand mb-4" href="Home">
    <img src="assets/images/web-logo.png" alt="Logo" class="logo-img" />
    SMA NEGERI 2 TONDANO
  </a>



  <div class="container" style="width: 100%">
<!-- Modal -->
<div class="modal fade text-black" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Langkah - Langkah Pendaftaran</h1>
          <p><strong>Tanggal Pendaftaran :</strong> <span id="tanggalDibuka"></span> - <span id="tanggalDitutup"></span></p>
        </div>
      </div>
      
      <div class="modal-body">
        <div id="pendaftaranAktif">
          <ol>
            <li><strong>Link Pendaftaran:</strong> Kunjungi situs web resmi untuk pendaftaran <a href="https://psbsma2tondano.online/Daftar-Akun">https://psbsma2tondano.online/Daftar-Akun</a></li>
            <li><strong>Buat Akun:</strong>Masukkan informasi yang diperlukan untuk membuat akun baru.</li>
            <li><strong>Verifikasi Email:</strong> Buka email yang terdaftar dan masukkan kode verifikasi yang dikirim oleh sistem.</li>
            <li><strong>Isi Formulir Pendaftaran:</strong> Setelah verifikasi, login ke akun Anda dan lengkapi formulir pendaftaran dengan data pribadi yang diperlukan.</li>
            <li><strong>Unggah Dokumen:</strong> Unggah dokumen yang diperlukan seperti Kartu Keluarga, ijazah, raport, akte kelahiran sesuai dengan petunjuk yang diberikan.</li>
            <li><strong>Verifikasi Pendaftaran:</strong> Periksa kembali semua informasi yang telah diisi, lalu klik "Verifikasi Pendaftaran" untuk mengirimkan pendaftaran Anda.</li>
          </ol>
          
        </div>
        <div id="pendaftaranTutup" style="display: none;">
          <p>Pendaftaran Tutup</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Saya Mengerti</button>
      </div>
    </div>
  </div>
</div>


    <div class="row d-flex justify-content-end">
      <div class="col-md-6 d-flex justify-content-center align-items-lg-center">
        <div class="text-desct">
          <h2>Formulir Registrasi</h2>
          <p>
            Silahkan lengkapi formulir dengan data yang valid. klik link ini
            untuk mendownload brosur pendaftaran
          </p>
          <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Langkah Pendaftaran!</button>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card shadow" style="border: none">
          <div class="card-body p-4">
            <h2 class="text-center">Registrasi Akun</h2>

            <form id="dataAkun" class="needs-validation" novalidate>
              <div class="row justify-content-center">
                <div class="col-sm-9 has-validation">
                  <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                  <input
                    type="text"
                    class="form-control"
                    id="namaLengkap"
                    name="namaLengkap"
                    required
                    autocomplete="off"
                  />
                  <div class="invalid-feedback">
                    Please provide valid nama lengkap.
                  </div>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-9 has-validation">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                    autocomplete="off"
                  />
                  <div class="invalid-feedback">
                    Please provide valid email.
                  </div>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-9">
                  <label class="col-sm-4 col-form-label">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required
                  />
                  <div class="invalid-feedback">
                    Please provide valid password.
                  </div>
                </div>
              </div>
              <div class="row mb-3 justify-content-center">
                <div class="col-sm-9">
                  <label class="col-sm-6 col-form-label"
                    >Konfirmasi Password</label
                  >
                  <input
                    type="password"
                    class="form-control"
                    id="konfirmasiPassword"
                    name="konfirmasiPassword"
                    required
                  />
                  <div class="invalid-feedback">Password tidak sesuai.</div>
                </div>
              </div>
              <div
                class="subbtn d-flex align-items-center justify-content-center"
              >
                <button type="submit" id="btnSubmit" class="btn btn-primary">
                  Daftar Akun
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
            <div class="d-flex justify-content-around mt-4">
              <p style="margin-right: 50px">
                Already Have Account?<a
                  href="Login"
                  style="text-decoration: none"
                >
                  Login</a
                >
              </p>
              <p>
                <a href="lupa-password" style="text-decoration: none"
                  >Lupa Password?</a
                >
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="lib/scripts/reqDaftar.js"></script>
<style>
  .navbar{
    display: none;
  }


  .btn{
    border-radius: 3px;
  }

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
