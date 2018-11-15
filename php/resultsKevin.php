<!DOCTYPE html>
<html lang="en">
<head>
<?php
	var_dump($_POST);
	$keyword = $_POST["searchKeyword"];
	$country = $_POST["searchCountry"];
?>
  <meta charset="utf-8">
  <title>SEODaddy</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="bootstrap/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="bootstrap/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="bootstrap/lib/animate/animate.min.css" rel="stylesheet">
  <link href="bootstrap/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="bootstrap/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="bootstrap/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="bootstrap/css/style.css" rel="stylesheet">

</head>
<body class="Site">

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro"><img src="img/seodaddy-logo-small.png" alt="logo" title="logo" /></a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="/">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="faq.html">FAQ</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main" class="Site-content">

    <!--==========================
      Search Section
    ============================-->
    <section id="results">
      <div style="background-color: white" class="jumbotron text-center">
        <div class="container">
          <div class="row">
            <div class="col-12">

        <header class="section-header">
            <h3>Results</h3>
        </header>
        <body>
            I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot. I'm a little tea pot.
            <br><br>
            <?php echo $keyword?>
			<?php echo $country?>
        </body>
        
    </section><!-- #featured-services -->

  </main>

  <!--==========================
    Footer
  ============================-->
    <footer id="footer">
    <div class="container">
        <div class="footer-info">
            <div class="credits">
                &copy; Copyright <strong>SEODaddy</strong>. All Rights Reserved<br>
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade.</a><br>
                API powered by <a href="https://dataforseo.com/">DataForSEO</a> and <a href="https://trumpia.com/">Trumpia.</a>
            </div>
        </div>
    </div>
    </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="bootstrap/lib/jquery/jquery.min.js"></script>
  <script src="bootstrap/lib/jquery/jquery-migrate.min.js"></script>
  <script src="bootstrap/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap/lib/easing/easing.min.js"></script>
  <script src="bootstrap/lib/superfish/hoverIntent.js"></script>
  <script src="bootstrap/lib/superfish/superfish.min.js"></script>
  <script src="bootstrap/lib/wow/wow.min.js"></script>
  <script src="bootstrap/lib/waypoints/waypoints.min.js"></script>
  <script src="bootstrap/lib/counterup/counterup.min.js"></script>
  <script src="bootstrap/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="bootstrap/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="bootstrap/lib/lightbox/js/lightbox.min.js"></script>
  <script src="bootstrap/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="bootstrap/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="bootstrap/js/main.js"></script>

</body>
</html>
