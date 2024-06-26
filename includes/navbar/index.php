<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="styleshet" href="/assets/css/nvstyle.css" /> 
<link rel="stylesheet" href="assets/adminAssets/css/fonts.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<style>
    .navbar-brand img{
        width: 50px;
        height: 40px;
    }
</style>
 <section>
    <nav id="navbar-example2" class="navbar navbar-expand-lg fixed-top">
        <div class="container mt-3 mb-3">
            <a class="navbar-brand" href="Home" id="myNavbarBrand">
                <img src="assets/images/web-logo.png" alt="Logo" class="logo-img">
                SMA NEGERI 2 TONDANO
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-three-dots-vertical" style="color: white;"></i>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#Home"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Jadwal"><i class="fas fa-calendar-alt"></i> Jadwal Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Info"><i class="fas fa-info-circle"></i> Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Kontak"><i class="fas fa-graduation-cap"></i> Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Login"><i class="fas fa-users"></i> Login</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</section>
    <script>
    $(function() {
        $(document).scroll(function() {
            var $nav = $(".navbar");
            $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".navbar-toggler").click(function () {
            $("#navbar-example2").toggleClass("navbar-bg-color");
        });
    });
</script>
<style>
    .navbar-bg-color {
        background-color: #33334e !important;
    }
    @media (max-width: 576px) {
        .navbar-brand{
            font-size: 15;
        }
    } 

</style>
