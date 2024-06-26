<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Portal: Admin Pendaftaran Siswa</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <!-- Fonts and icons -->
    <script src="assets/adminAssets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Lato:300,400,700,900"] },
        custom: {
          families: [
            "Flaticon",
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/adminAssets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/adminAssets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/adminAssets/css/atlantis.min.css" />

  </head>
  <body>
    <div class="wrapper">
      <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header " data-background-color="blue">
          <a href="index.html" class="logo">
            <img
              src="assets/images/web-logo.png"
              alt="navbar brand"
              class="navbar-brand mt-1 "
            />
          </a>

          <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
              <i class="icon-menu"></i>
            </span>
          </button>
          
          <button class="topbar-toggler more">
            <i class="icon-options-vertical"></i>
          </button>
         <div class="nav-toggle mt-3">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="icon-menu"></i>
            </button>
          </div>
        </div>

        <!-- Navbar Header -->
        <nav
          class="navbar navbar-header navbar-expand-lg"
          data-background-color="blue2"
        >
          <div class="container-fluid">
            <div class="collapse" id="search-nav">
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
              <li class="nav-item toggle-nav-search hidden-caret">
              </li> 
              <li class="nav-item dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-toggle="dropdown"
                  href="#"
                  aria-expanded="false"
                >
                  <div class="avatar-sm">
                    <img
                      src="assets/images/user-img.jpg"
                      alt="..."
                      class="avatar-img rounded-circle"
                    />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img
                            src="assets/images/user-img.jpg"
                            alt="image profile"
                            class="avatar-img rounded"
                          />
                        </div>
                        <div class="u-text">
                          <h4>Admin</h4>
                          <p class="text-muted"></p>
                          <a
                            href="profile.html"
                            class="btn btn-xs btn-secondary btn-sm"
                            >View Profile</a
                          >
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Account Setting</a>
                      <div class="dropdown-divider"></div>
                      <p class="dropdown-item btn btn-sm-primary" id="logout-button">Logout</p>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <!-- Sidebar -->
      <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <div class="user">
              <div class="avatar-sm float-left mr-2">
                <img
                  src="assets/images/user-img.jpg"
                  alt="..."
                  class="avatar-img rounded-circle"
                />
              </div>
              <div class="info">
                <a
                  data-toggle="collapse"
                  href="#collapseExample"
                  aria-expanded="false"
                >
                  <span>
                    Admin
                    <span class="user-level">Administrator</span>
                    <span class="caret"></span>
                  </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample">
                  <ul class="nav">
                    <li>
                      <a href="#profile">
                        <span class="link-collapse">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="#edit">
                        <span class="link-collapse">Edit Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="#settings">
                        <span class="link-collapse">Settings</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <ul class="nav nav-primary">
              <li class="nav-item active">
                <a
                  href="Dashboard"
                  class=""
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <!-- <span class="caret"></span> -->
                </a>
                <div></div>
              </li>

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Fitur</h4>
              </li>
              <li class="nav-item">
                <a data-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Management</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="Unverified-Pendaftaran">
                        <span class="sub-item">Unverified Pendaftaran</span>
                      </a>
                    </li>
                    <li>
                      <a href="Verified-Pendaftaran">
                        <span class="sub-item">Verified Pendaftaran</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-newspaper"></i>
                  <p>Berita/Pengumuman</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="Pengumuman">
                        <span class="sub-item">Upload PDF Pengumuman</span>
                      </a>
                    </li>
                    <li>
                      <a href="create-news">
                        <span class="sub-item">Create News</span>
                      </a>
                    </li>
                    <li>
                      <a href="list-news">
                        <span class="sub-item">List Berita</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="jadwal-kegiatan">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Jadwal Kegiatan</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <style>
      .navbar-brand{
        width: 50px;
        height: 50px;
      }
      </style>



    <script src="assets/adminAssets/js/core/bootstrap.min.js"></script>
    <script src="assets/adminAssets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/adminAssets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="assets/adminAssets/js/atlantis.min.js"></script>


<script>
  $(document).ready(function () {
  
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
        
        $.ajax({
          type: 'POST',
          url: '/controllers/LogoutAction.php', 
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
             
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