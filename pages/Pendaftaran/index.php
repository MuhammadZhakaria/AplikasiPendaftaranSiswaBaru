<?php
  session_start();
  if(!$_SESSION['id_user']){
    header("location: Login");
  }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="assets/css/additionalStylePS.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>


<?php 
  include("shared/dashboardSiswa.php"); 
?>

<style>
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
            <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
            <h5 class="text-white op-7 mb-2">
              
            </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="row mx-auto mt-3">
      <div class="col-sm-12" id="desc-call">
        <div class="bs-callout bs-callout-info bs-callout-md">
          <h4>TATA CARA PENDAFTARAN</h4>
          <ul>
            <li>Isikan data dengan data yang valid</li>
            <li>Data tidak boleh kosong</li>
            <li>File Photo harus berukuran 4x6 dan tidak lebih dari 2MB</li>
            <li>Berkas file yang diuggah, harus format .pdf dengan tidak lebih dari 2MB</li>
            <li>Periksa semua data sebelum melakukan verifikasi pendaftaran</li>
          </ul>
        </div>
      </div>
              <div id="loading-spinner" class="d-none justify-content-center align-items-center">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
      <div class="col-sm-12" mx-auto>
        <div class="card">
          <div class="card-body" id="unverifiedCardBody">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active"
                  id="home-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#home-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="home-tab-pane"
                  aria-selected="true"
                >
                  Data Pribadi
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="profile-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="profile-tab-pane"
                  aria-selected="false"
                >
                  Data Pendidikan
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="contact-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#contact-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="contact-tab-pane"
                  aria-selected="false"
                >
                  Data Keluarga
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="berkas-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#berkas-tab-pane"
                  type="button"
                  role="tab"
                  aria-controls="berkas-tab-pane"
                  aria-selected="false"
                >
                  Berkas
                </button>
              </li>
            </ul>
          
            <div class="tab-content" id="myTabContent">
              <div
                class="tab-pane fade show active"
                id="home-tab-pane"
                role="tabpanel"
                aria-labelledby="home-tab"
                tabindex="0"
              >
                <form id="dataSiswa" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                  <div class="row mx-auto">
                    <!-- For demo purpose -->
                    <div class="row mb-3 mx-auto">
                      <div class="col-sm-5">
                        <div class="image-area mt-4">
                          <img
                            id="imageResult"
                            src="src/images/upldImage.jpg"
                            alt=""
                            class="img-fluid rounded shadow-sm mx-auto d-block"
                          />
                        </div>
                      
                        <div class="input-group mb-5 rounded-pill bg-white shadow-sm">
                          <input
                            type="file"
                            id="upload"
                            onchange="readURL(this);"
                            class="form-control border-0"
                            accept=".jpg, .png, .jpeg"
                            name="pasFoto"
                            
                          />

                          <label
                            id="upload-label"
                            for="upload"
                            class="font-weight-light text-muted"
                            >Choose file</label
                          >
                          <div class="input-group-append">
                            <label for="upload" class="btn btn-light rounded-pill px-4">
                              <i class="fa fa-cloud-upload mr-2 text-muted"></i
                              ><small class="text-uppercase font-weight-bold text-muted"
                                >Choose file</small
                              ></label
                            >
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-6 has-validation">
                        <input
                          type="text"
                          class="form-control"
                          id="nmalengkap"
                          name="nmaLengkap"
                          readonly
                          value="<?php if (isset($_SESSION['nama_lengkap'])) {
                          echo $_SESSION['nama_lengkap'];
                          } ?>"
                        />
                        <div class="invalid-feedback">Please select a valid nama lengkap.</div>
                      </div>
                      </div>
                    <div class="row mb-3 ">
                      <label class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-6 has-validation">
                        <input type="email" class="form-control" id="email" name="email" value="<?php  if (isset($_SESSION['Email'])) {
                          echo $_SESSION['Email'];
                          } ?>"  readonly/>
                        <div class="invalid-feedback">Please select a valid email.</div>
                      </div>
                      
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">NISN</label>
                      <div class="col-sm-3 has-validation">
                        <input
                          type="number"
                          class="form-control"
                          id="nisn"
                          name="nisn"
                          autocomplate="off"
                          required
                        />
                        <div class="invalid-feedback">Please provide a valid nis.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-6 has-validation ">
                        <select
                          class="form-select"
                          aria-label="Default select example"
                          id="jenisKelamin"
                          name="jenisKelamin"
                          required
                        >
                          <option selected>Jenis Kelamin</option>
                          <option value="lakiLaki">Laki - Laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">Please select a valid jenis kelamin.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-4 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-6 has-validation">
                        <input
                          type="text"
                          class="form-control"
                          id="tempatLahir"
                          name="tempatLahir"
                          autocomplate="off"
                          required
                        />
                        <div class="invalid-feedback">Please provide a valid tempat lahir.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-4 has-validation">
                        <div class="inputDate ">
                          <input
                            id="datepicker"
                            name="tanggalLahir"
                            id="tanggalLahir"
                            width="276"
                            required
                          />
                          
                        </div>
                        <div class="invalid-feedback">Please select a valid email.</div>
                      </div>
                    </div>
              

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Nomor HP</label>
                    <div class="col-sm-6 has-validation">
                      <input
                        type="number"
                        class="form-control"
                        id="noHP"
                        name="noHP"
                        autocomplete="off"
                        required
                      />
                      <div class="invalid-feedback">Please provide a valid No HP.</div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Agama</label>
                    <div class="col-sm-6 has-validation">
                      <input
                        type="text"
                        class="form-control"
                        id="agama"
                        name="agama"
                        autocomplete="off"
                        required
                      />
                      <div class="invalid-feedback">Please select a valid agama.</div>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-6 has-validation">
                        <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                      <div class="invalid-feedback">Please select a valid agama.</div>
                    </div>
                  </div>

                  

                  <div class="row mb-3">
                    <label for="province-select" class="col-sm-4 col-form-label"
                      >Pilih Provinsi</label
                    >
                    <div class="col-sm-6 has-validation">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        id="province-select"
                        name="province"
                        required
                      ></select>
                      <div class="invalid-feedback">Please select a valid provinsi.</div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="regency-select" class="col-sm-4 col-form-label"
                      >Pilih Kab/Kota</label
                    >
                    <div class="col-sm-6 has-validation">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        id="regency-select"
                        name="regency"
                        required
                      ></select>
                      <div class="invalid-feedback">Please select a valid kab/kota.</div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="district-select" class="col-sm-4 col-form-label"
                      >Pilih Kecamatan</label
                    >
                    <div class="col-sm-6 has-validation">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        id="district-select"
                        name="district"
                        required
                      ></select>
                      <div class="invalid-feedback">Please select a valid kecamatan.</div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="village-select" class="col-sm-4 col-form-label"
                      >Kelurahan</label
                    >
                    <div class="col-sm-6 has-validation">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        id="village-select"
                        name="village"
                        required
                      ></select>
                      <div class="invalid-feedback">Please select a valid kelurahan.</div>
                    </div>
                  </div>
                  <div class="btnC d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary mt-2" style="width: 100px">
                      Save
                    </button>
                  </div>
                  </div>
                </form>

                </div>


                <div
                class="tab-pane fade"
                id="profile-tab-pane"
                role="tabpanel"
                aria-labelledby="profile-tab"
                tabindex="0"
              >
               <form id="dataSekolah" class="row g-3 mt-5 needs-validation" novalidate>
                    <div class="row mb-3">
                      <label for="asalSekolah" class="col-sm-4 col-form-label">Asal Sekolah</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="asalSekolah" name="asalSekolah" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid asal sekolah.</div>
                      </div>
                    </div>

                     <div class="row mb-3">
                      <label for="alamatSekolah" class="col-sm-4 col-form-label">Alamat Sekolah</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="alamatSekolah" name="alamatSekolah" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid alamat sekolah.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tahunMskLulus" class="col-sm-4 col-form-label">Tahun Masuk - Tahun Keluar</label>
                      <div class="col-sm-2">
                        <input type="number" class="form-control" id="thunMasuk" name="thunMasuk" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid tahun masuk.</div>
                      </div>
                      <div class="col-sm-2">
                        <input type="number" class="form-control" id="thuhLulus" name="thuhLulus" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid tahun keluar.</div>
                      </div>
                    </div>

    
                     <div class="btnC d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary mt-2" style="width: 100px">
                    Save
                  </button>
                </div>
              </form>
              </div>


              <div
                class="tab-pane fade"
                id="contact-tab-pane"
                role="tabpanel"
                aria-labelledby="contact-tab"
                tabindex="0"
              >
                <form id="dataKeluarga" class="row g-3 mt-5 needs-validation" novalidate>
                    <div class="row mb-3">
                      <label for="namaAyah" class="col-sm-4 col-form-label">Nama Ayah</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="namaAyah" name="namaAyah" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid nama ayah.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="namaIbu" class="col-sm-4 col-form-label">Nama Ibu</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="namaIbu" name="namaIbu" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid nama ibu.</div>
                      </div>
                    </div>

                     <div class="row mb-3">
                      <label for="kontakOrtu" class="col-sm-4 col-form-label">No HP Orang Tua</label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="kontakOrtu" name="kontakOrtu" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid kontak orang tua.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="namaWali" class="col-sm-4 col-form-label">Nama Wali</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="namaWali" name="namaWali" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid nama wali.</div>
                      </div>
                    </div>

                      <div class="row mb-3">
                      <label for="hubungan" class="col-sm-4 col-form-label">Hubungan</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="hubungan" name="hubungan" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid hubungan.</div>
                      </div>
                    </div>

                      <div class="row mb-3">
                      <label for="kontakWali" class="col-sm-4 col-form-label">No HP Wali</label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="kontakWali" name="kontakWali" required autocomplete="off" />
                        <div class="invalid-feedback">Please input a valid kontak wali.</div>
                      </div>
                    </div>
                  <div class="btnC d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary mt-2" style="width: 100px">
                    Save
                  </button>
                </div>
                </form>
              </div>
              <div
                class="tab-pane fade"
                id="berkas-tab-pane"
                role="tabpanel"
                aria-labelledby="berkas-tab"
                tabindex="0"
              >
              <form id="dataBerkas" class="row g-3 mt-5 needs-validation" novalidate>
                <div class="row mb-3">
                  <label for="fileIjazah" class="col-sm-4 col-form-label">Upload Ijazah</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control" id="fileIjazah" name="fileIjazah" accept=".pdf" required />
                      </div>
                </div>

                <div class="row mb-3">
                  <label for="nilaiRaport" class="col-sm-4 col-form-label">Upload Nilai Raport</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control" id="fileRaport" name="fileRaport" accept=".pdf" required />
                      </div>
                </div>

                  <div class="row mb-3">
                      <label  class="col-sm-4 col-form-label">Upload Kartu Keluarga</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control" accept=".pdf" id="kartuKeluarga" name="kartuKeluarga" required>
                    </div>
                    <div class="invalid-feedback">Please input a valid file.</div>
                </div>

                  <div class="row mb-3">
                      <label  class="col-sm-4 col-form-label">Upload Akte Kelahiran</label>
                      <div class="col-sm-6">
                        <input type="file" class="form-control" accept=".pdf" id="akteLahir" name="akteLahir" required>
                    </div>
                    <div class="invalid-feedback">Please input a valid file.</div>
                </div>
                  <div class="btnC d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary mt-2" style="width: 100px">
                    Save
                  </button>
                </div>
              </form>                                                 
                <div class="finalization mb-3 d-flex justify-content-center items-align-center " style="margin-top: 70px; ">
                <a id="verifPendaftaran" class ="btn btn-success" href="">Verifikasi Pendaftaran</a>
              </div>
              </div>
            </div>
          </div>

          <div class="card-body" id="verifiedCardBody">
            <div class="row">
          <div class="col-md-3">
            <img class="image-area img-fluid rounded mx-auto d-block" id="img-verif" src="src/images/upldImage.jpg" />
          </div>
          <div class="col-md-8">
            <div class="p-1 mt-4">
                <h1 class="display-6 fw-semibold" id="nama"></h1>
                <p class="lead fw-medium txt-desc" id="mail"></p>
                <p class="lead fw-medium txt-desc" id="no"></p>
                <p class="lead fw-medium txt-desc" id="almt">Alamat  : Jln Darusslam, Kelurhan motoboi kecil</p>
                <p class="lead fw-medium txt-desc text-info" id="stts"></p>
              </div>
          </div>
          </div>

        <div class="desc d-flex align-items-center justify-content-center">
          <div class="row mx-auto">
            <div class="col-sm-12">
              <div class="lead fw-medium text-center">Anda telah melakukan verifikasi, data-data anda tidak dapat diubah kembali!, proses pengumuman akan kami infokan di halaman ini</div>
            </div>
          </div>
        </div>

        <div class="desc d-flex align-items-center justify-content-center mt-5">
          <div class="row mx-auto">
            <div class="col-sm-12">
              <a class="btn btn-success" id="btnBuktiKelulusan" href="/controllers/actionBuktiKelulusan.php">Unduh Bukti Kelulusan</a>
            </div>
          </div>
        </div>
        </div>

        <div class="card-body" id="IsNotSchedule">
        <div class="desc d-flex align-items-center justify-content-center" style="height:300px;">
          <div class="row mx-auto">
            <div class="col-sm-12">
              <div class="lead fw-medium text-center">Bukan masa pendaftaran murid baru!</div>
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
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<script>function showImage(id) {
  window.location.href = 'controllers/showImage.php?id=' + id;
}</script>

<script>
  $(document).ready(function() {
    
  $("#dataSiswa").submit(function(event) {
    event.preventDefault();

    var input = document.getElementById('upload');
    if (input.files && input.files[0]) {
      var formData = new FormData(this);
      formData.append('image', input.files[0]);
    
    var selectedProvinsi = $("#province-select option:selected").text();
    var selectedRegency = $("#regency-select option:selected").text();
    var selectedDistrict = $("#district-select option:selected").text();
    var selectedVillage = $("#village-select option:selected").text();

    // // Menggabungkan nama wilayah yang dipilih dengan formData
    formData.append('province', selectedProvinsi);
    formData.append('regency', selectedRegency);
    formData.append('district', selectedDistrict);
    formData.append('village', selectedVillage);
    $("#loading-spinner").removeClass("d-none");
      
      $.ajax({
        url: '/controllers/PendaftaranController.php',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
          $("#loading-spinner").addClass("d-none");
          if(response.status == 'success'){
              Swal.fire('Sukses', response.message, 'success');
          }
        },
        error: function() {
          console.log("Error in AJAX request.");
        }
      });
    }
  });
});
</script>

<script>
   $(document).ready(function() {
   $("#dataSekolah").submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);

      $("#loading-spinner").removeClass("d-none");
      $.ajax({
        url: '/controllers/dataSekolahAction.php',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $("#loading-spinner").addClass("d-none");
          if(response.status === 'success'){
             Swal.fire('Sukses', response.message, 'success');
          }else if(response.status === 'error'){
            Swal.fire('Error', response.message, 'error');
          }
        },
        error: function() {
          console.log("Error in AJAX request.");
        }
      });
  });
});
</script>

<script>
    $(document).ready(function() {
     $("#dataKeluarga").submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      $("#loading-spinner").removeClass("d-none");
        $.ajax({
          url: '/controllers/dataKeluargaAction.php',
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            $("#loading-spinner").addClass("d-none");
            if(response.status === 'success'){
              Swal.fire('Success', response.message, 'success');
            }else if(response.status === 'error'){
              Swal.fire('Error', response.message, 'error');
            }
          },
          error: function() {
            console.log("Error in AJAX request.");
          }
        });
      });
  });
</script>

<script>
   $(document).ready(function() {
   $("#dataBerkas").submit(function(event) {
    event.preventDefault();

      var formData = new FormData();
      formData.append('fileIjazah', $('#fileIjazah')[0].files[0]);
      formData.append('fileRaport', $('#fileRaport')[0].files[0]);
      formData.append('kartuKeluarga', $('#kartuKeluarga')[0].files[0]);
      formData.append('akteLahir', $('#akteLahir')[0].files[0]);
      $("#loading-spinner").removeClass("d-none");
      $.ajax({
        url: '/controllers/dataBerkasAction.php',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $("#loading-spinner").addClass("d-none");
          if(response.status === 'success'){
            Swal.fire('Success', response.message, 'success');
          }else if(response.status === 'error'){
            Swal.fire('Error', response.message, 'error');
          }
        },
        error: function() {
          console.log("Error in AJAX request.");
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

<script>
    
    const provinceSelect = document.getElementById("province-select");
    const regencySelect = document.getElementById("regency-select");
    const districtSelect = document.getElementById("district-select");
    const villageSelect = document.getElementById("village-select");

    fetchProvinces();

    provinceSelect.addEventListener("change", fetchRegencies);
    regencySelect.addEventListener("change", fetchDistricts);
    districtSelect.addEventListener("change", fetchVillages);

    function fetchProvinces() {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
            .then(response => response.json())
            .then(provinces => {

                provinces.forEach(province => {
                    const option = document.createElement("option");
                    option.value = province.id;
                    option.text = province.name;
                    provinceSelect.appendChild(option);
                });
            })
            .catch(error => console.error(error));
    }

    function fetchRegencies() {
        const selectedProvinceId = provinceSelect.value;
        regencySelect.innerHTML = "<option value=''>Pilih Kota/Kabupaten</option>"; // Bersihkan opsi sebelum menambahkannya kembali

        if (selectedProvinceId) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinceId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    // Tambahkan opsi kota/kabupaten ke elemen select
                    regencies.forEach(regency => {
                        const option = document.createElement("option");
                        option.value = regency.id;
                        option.text = regency.name;
                        regencySelect.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
        }
    }

    function fetchDistricts() {
        const selectedRegencyId = regencySelect.value;
        districtSelect.innerHTML = "<option value=''>Pilih Kecamatan</option>"; // Bersihkan opsi sebelum menambahkannya kembali

        if (selectedRegencyId) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${selectedRegencyId}.json`)
                .then(response => response.json())
                .then(districts => {
                    // Tambahkan opsi kecamatan ke elemen select
                    districts.forEach(district => {
                        const option = document.createElement("option");
                        option.value = district.id;
                        option.text = district.name;
                        districtSelect.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
        }

        
    }
    function fetchVillages() {
        const selectedDistrictId = districtSelect.value;
        villageSelect.innerHTML = "<option value=''>Pilih Kelurahan/Desa</option>"; // Bersihkan opsi sebelum menambahkannya kembali

        if (selectedDistrictId) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${selectedDistrictId}.json`)
                .then(response => response.json())
                .then(villages => {
                    // Tambahkan opsi kelurahan/desa ke elemen select
                    villages.forEach(village => {
                        const option = document.createElement("option");
                        option.value = village.id;
                        option.text = village.name;
                        villageSelect.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
        }
    }
</script>

<script>
      $('#datepicker').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'yyyy-mm-dd'
        });
</script>


<!-- <script>
  function verifikasiPendaftaran(){
    swal({
      title: 'Konfirmasi Verifikasi',
      text: 'Apakah anda yakin ingin memverifikasi pendaftaran?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Verifikasi',
      cancelButtonText: 'Batal'
    }).then((result) =>{
      if(result.isConfirmed){
        const url = '';
        const data = {
          Id_calonSiswa: Id_calonSiswa
        };

        $.ajax({
          type:'POST',
          url: url,
          data: data,
          success:function(response){
            swal('Verifikasi Berhasil', 'Pendaftaran telah diverifikasi','success');
          },
          error: function(error){
            swal('Kesalahan', 'Terjadi kesalahan saat memverifikasi pendaftaran.', 'error');
          }
        });
      }
    });
  }
</script> -->

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}
</script>


<script>
  $(document).ready(function () {
  function getDatasiswa(data) {
    $("#imageResult").attr("src", "data:image/jpeg;base64," + data.FotoSiswa);
    $("#img-verif").attr("src", "data:image/jpeg;base64," + data.FotoSiswa);
    //var prov = 14;
    // Setelah Anda memiliki ID provinsi, Anda dapat mencari opsi yang sesuai dalam elemen "province-select"

    $("#upload-label").text(data.FileNames);

    $('#nmalengkap').val(data.NamaLengkap);
    $('#nama').text(data.NamaLengkap);
    // $('#userId').val(data.user_Id);
    $('#email').val(data.Email);
    $('#mail').text(data.Email);
    $('#nisn').val(data.NISN);

    $('#jenisKelamin').val(data.JenisKelamin);
    $('#tempatLahir').val(data.TempatLahir);
    $('#datepicker').val(data.TanggalLahir);
    
    $('#noHP').val(data.NoHp);
    $('#no').text("NoHp   : " + data.NoHp);

    

    $('#almt').text(data.Alamat)


    $('#agama').val(data.Agama);

    $('#alamat').val(data.Alamat);
    // $('#province-select').val(provinsiId);
    // $('#district-select').val(data.Kecamatan);
    // $('#village-select').val(data.Kelurahan);
    // Untuk menampilkan gambar, jika Anda ingin menampilkannya dalam elemen gambar, Anda perlu mengatur src atributnya
    
  }

  $.ajax({
    url: '/controllers/getDataSiswa.php',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      if (data.error) {
        console.log(data.error);
      } else {
        getDatasiswa(data);
      }
    },
    error: function (error) {
      console.log('Error in AJAX request: ' + JSON.stringify(error));
    }
  });
});
</script>

<script>
  $(document).ready(function () {
    $("#verifPendaftaran").on("click", function (event) {
      event.preventDefault();

      var forms = document.querySelectorAll("form.needs-validation");

      var isValid = true;

      forms.forEach(function (form) {
        if (!form.checkValidity()) {
          form.classList.add("was-validated");
          isValid = false;
        }
      });

      if (!isValid) {
        Swal.fire("Error", "Formulir tidak boleh kosong, silahkan lengkapi", "error");
        return;
      }

      Swal.fire({
        title: "Konfirmasi",
        text: "Anda yakin ingin memverifikasi? Data tidak dapat dirubah kembali!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/controllers/verificationPendaftaran.php',
            method: 'POST',
            dataType: 'json',
            success: function (response) {
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
            error: function (error) {
              console.log("Error in AJAX request.." + JSON.stringify(error));
              Swal.fire("Error", "Terjadi kesalahan dalam perintaan AJAX");
            },
          });
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#verifiedCardBody').hide();
    $.ajax({
      url: '/controllers/getVerifiedStatus.php',
      method: 'GET',
      dataType: 'json',
      success: function (response){
        if(response.status === 'success'){
          var IsVerified = response.IsVerified;

          if(IsVerified === true){
            $('#verifiedCardBody').show();
            $('#unverifiedCardBody').hide();
            $('#desc-call').hide();

            if (response.Status === "LULUS") {
              $('#btnBuktiKelulusan').show();
            } else {
              $('#btnBuktiKelulusan').hide();
            }
          
            var statusText = 'Status: ' + response.Status;
          $('#stts').text(statusText);
              var badgeColorClass;
              switch (response.Status) {
                case 'LULUS':
                  badgeColorClass = 'text-success';
                  break;
                case 'Dalam Proses Seleksi':
                  badgeColorClass = 'text-primary';
                  break;
                default:
                  badgeColorClass = 'text-danger';
              }

              $('#stts').addClass(badgeColorClass);
          }else{
            $('#verifiedCardBody').hide();
            $('#unverifiedCardBody').show();
              Swal.fire({
                title: 'Lengkapi Pendaftaran',
                text: 'Anda belum melengkapi form pendaftaran dan verifikasi pendaftaran',
                icon: 'info'
              });
            $('#desc-call').show();
          }
        }else{
          console.log('gagal mengambil status Isverified' + response.message);
        }
      },
      error: function (error){
        console.log('Error in AJAX request: ' + JSON.stringify(error));
      }
    });
  });
</script>

<script>
  $(document).ready(function () {
  // Logout saat tombol keluar diklik
  $("#logout-button").click(function () {
    Swal.fire({
      title: 'Konfirmasi Logout',
      text: 'Anda yakin ingin keluar?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Keluar',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        // Lakukan logout dengan permintaan AJAX
        $.ajax({
          type: 'POST',
          url: '/controllers/LogoutAction.php', // Gantilah dengan URL logout Anda
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              // Redirect ke halaman login setelah logout berhasil
              window.location.href = 'Login';
            } else {
              Swal.fire('Error', 'Gagal logout', 'error');
            }
          },
          error: function () {
            Swal.fire('Error', 'Terjadi kesalahan saat logout', 'error');
          },
        });
      }
    });
  });
});
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      type: 'GET',
      url: '/controllers/jadwalPendaftaran.php',
      dataType: 'json',
      success: function(response){
        if(response.status === 'active'){
          // Swal.fire('Jadwal Aktif', 'Anda dapat melakukan pendaftaran', 'success');
         
          $('#IsNotSchedule').hide();
        }else if(response.status == 'inactive'){
          Swal.fire('Jadwal Belum Dibuka', 'Pendaftaran belum dibuka.', 'info').then((result) => {
            if(result.isConfirmed){
              $('#verifiedCardBody').hide();
              $('#IsNotSchedule').show();
              $('#unverifiedCardBody').hide();
              $('#desc-call').hide();
            }
          })

        } else{
          Swal.fire('Kesalahan', 'Terjadi kesalahan dalam memeriksa jadwal', 'error');
        }
      },
      error: function(){
        Swal.fire('Kesalahan', 'Terjadi kesalahan dalam permintaan', 'error');
      }
    })
  })
</script>

<script>
  $(document).ready(function() {
    function getDataPendidikan(data){
      $('#asalSekolah').val(data.NamaSekolah);
      $('#alamatSekolah').val(data.AlamatSekolah);
      $('#thunMasuk').val(data.TahunMasuk);
      $('#thuhLulus').val(data.TahunKeluar);
    }

    $.ajax({
      url: '/controllers/getDataSekolah.php',
      method: 'GET',
      dataType: 'json',
      success: function(data){
        if(data.error){
          console.log(data.error);
        }else{
          getDataPendidikan(data);
        }
      },
      error: function(error){
        console.log('Error in AJAX request: ' + JSON.stringify(error));
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
      function getDataKeluarga(data){
        $('#namaAyah').val(data.NamaAyah);
        $('#namaIbu').val(data.NamaIbu);
        $('#kontakOrtu').val(data.KontakOrtu);
        $('#namaWali').val(data.NamaWali);
        $('#hubungan').val(data.Hubungan);
        $('#kontakWali').val(data.KontakWali);
      }
      
      $.ajax({
          url : '/controllers/getDataKeluarga.php',
          method : 'GET',
          dataType: 'json',
          success: function(data){
            if(data.error){
              console.log(data.error);
            }else{
              getDataKeluarga(data);
            }
          },
          error: function(error){
            console.log('Error in AJAX request: ' + JSON.stringify(error));
          }
      });
  });
</script>

