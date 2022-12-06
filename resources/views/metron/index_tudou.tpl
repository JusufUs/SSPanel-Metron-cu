<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="favicon.ico">
  <title>{$config["appName"]}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="assets/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
</head>

<body class="index-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#">
        </a>
      </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header header-filter">
      <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square4"></div>
      <div class="squares square5"></div>
      <div class="squares square6"></div>
      <div class="squares square7"></div>
      <div class="container">
        <div class="content-center brand" style="width:100%">
          <h1 class="h1-seo" style="font-size:4em;"><span class="typed" id="type-example" data-type-this="Google？, Youtube？, Netflix？, Twitch？, 易用|實惠, 極速|穩定, "></span></h1>
          <button type="button" class="btn btn-default" onclick="window.location.href='/auth/login'"><i class="tim-icons icon-single-02"></i> 登入</button>
          <button type="button" class="btn btn-default" onclick="window.location.href='/auth/register'"><i class="tim-icons icon-badge"></i> 註冊</button>
        </div>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-3">
            <ul class="nav">
              <li class="nav-item">
                <p>
                  服務
                </p>
              </li>
              <li class="nav-item">
                <a href="/user" class="nav-link">
                  用戶中心
                </a>
              </li>
              <li class="nav-item">
                <a href="/user/invite" class="nav-link">
                  推薦計劃
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-3">
            <ul class="nav">
              <li class="nav-item">
                <p>
                  條款及政策
                </p>
              </li>
              <li class="nav-item">
                <a href="/tos" class="nav-link">
                  服務條款
                </a>
              </li>

              <li class="nav-item">
                <a href="/aup" class="nav-link">
                  使用政策
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-6" style="padding-top: 35px;">
            <p>本網站為66JSQ.TOP Networks LLC(US)所有，受美國當地法律保護</p>
            <p>22901 Linden Blvd, # 37, Cambria Heights, New York, NY, USA</p>
            <p>© 2019 66JSQ.TOP Networks LLC. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
  <script src="assets/js/typed.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      blackKit.initDatePicker();
      blackKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>