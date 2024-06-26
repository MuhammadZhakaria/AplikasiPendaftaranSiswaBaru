<link rel="stylesheet" href="/assets/adminAssets/css/fonts.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="/assets/css/style.css"/>

<style>
    .sec-read{
        width: 100%;
    }
    .sidebar{
        position: sticky;
        top: 30px;
    }
</style>

<?php include("shared/homeLayout.php") ?>

<section class="sec-read" style="margin-top: 120px">
  <div class="container">
    <div class="row justify-content-center mx-auto">
      <div class="col-md-9">
        <div class="main mt-5"></div>
      </div>
      <div class="col-md-3 sidebar-fixed">
        <div class="sidebar mt-5">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" />
            <div class="input-group-append">
              <button class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    $(document).ready(function () {
       
        var urlParams = new URLSearchParams(window.location.search);
        var id_news = urlParams.get('id_news');

        if (id_news) {
            $.ajax({
                url: '/controllers/getDetailNews.php',
                method: 'GET',
                data: { id_news: id_news }, 
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        var updatedContent = response.content.replace(/src="data\//g, 'src="/data/');
                        $('.main').html(updatedContent);
                    } else {
                        console.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Gagal mengambil data konten. Status:', status, 'Error:', error);
                    console.log(xhr.responseText); 
                }
            });
        } else {
            console.error('Invalid id_news parameter in the URL.');
        }
        var logoImg = document.querySelector(".logo-img");
        logoImg.src = "../assets/images/web-logo.png";


        var myNavbarBrand = document.getElementById("myNavbarBrand");
        myNavbarBrand.href = "../Home";
    });
</script>

<link rel="stylesheet" href="assets/css/style.css"/>
<style>
    .image_resized{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    img {
        max-width: 100%;
        height: auto;
    }
    .navbar{
        background-color: #33334e;
    }

    input.form-control:focus{
	    box-shadow: none;
	    border: 1.5px solid #E3E6ED;
	    background-color: #F7F8FD;
	    letter-spacing: 1px;
    }
    .btn-primary{
	    background-color: #5878FF!important;
	    border-radius: 2px;
        height: 38px;
    }
    .btn-primary:focus{
	    box-shadow: none;
    }
</style>