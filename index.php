<?php
session_start();

if(isset($_SESSION["id_user"])){
	header("Location: main.php");
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>VTS Rent-a-Car</title>

	<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
	<link rel="manifest" href="img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#607d8b">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#607d8b">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#607d8b">

	<!-- EAGER  -->
  <script src="//fast.eager.io/w1gPT0mhb2.js"></script>

	<!-- jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<!-- CSS  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/custom.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/material-scrolltop.css">
	<link rel="stylesheet" type="text/css" href="css/materialPreloader.min.css">

</head>
<body>

	<!-- JavaScript Before -->
	<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
  <script type="text/javascript" src="js/plugins/materialize.min.js"></script>
	<script type="text/javascript" src="js/plugins/chance.min.js"/> </script>
	<script type="text/javascript" src="js/plugins/materialPreloader.min.js"></script>
  <script type="text/javascript" src="js/register.js"/> </script>
  <script type="text/javascript" src="js/login.js"/> </script>

	<script type="text/javascript">

	 preloader = new $.materialPreloader({
					position: 'top',
					height: '5px',
					col_1: '#159756',
					col_2: '#da4733',
					col_3: '#3b78e7',
					col_4: '#fdba2c',
					fadeIn: 200,
					fadeOut: 200
			});

		preloader.on();

	</script>

	<!-- Navigation -->
  <nav class="blue-grey" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">VTS Rent-A-Car</a>
		  <!-- Desktop Navigation -->
      <ul class="right hide-on-med-and-down">
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#signup">Sign Up</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#login">Login</a></li>
      </ul>
      <!-- Mobile Navigation -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#signup">Sign Up</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#login">Login</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<!-- Include Modals -->
<?php include("include/index_modals.html");?>


<!-- Start Banner Container -->
<div class="container">
   <div class="row center">
	    <h1 class="header center orange-text">VTS Rent-a-Car</h1>
	    <img id="image-test" class="responsive-img hoverable" src="img/intro.jpg">
   </div>
	 <div class="section no-pad-bot" id="index-banner">
		<div class="row center">
		 <ul class="collapsible popout" data-collapsible="accordion">
		  <li>
		    <div class="collapsible-header"><i class="material-icons">thumb_up</i>Fast</div>
		    <div class="collapsible-body"><p>Best Worldwide Car Hire Deals. We offer the fastest service out of all our competitors.</p></div>
		  </li>
		  <li>
		    <div class="collapsible-header"><i class="material-icons">https</i>Secure</div>
		    <div class="collapsible-body"><p>Your data is safe with us, except when we sell it to third parties for $.</p></div>
		  </li>
		  <li>
		    <div class="collapsible-header active"><i class="material-icons">description</i>About Us</div>
		    <div class="collapsible-body"><p>VTS's Rent-A-Car story dates back to 1934, when the company was founded in the Vojvodina to assist Serbs with car hire while visiting relatives in Europe. Ever since then our business concept has notably developed. Nowadays we are proud to offer our customers a comprehensive service, including not only car hire, but also motorhome and motorcycle hire, as well as chauffeur service.</p></div>
		  </li>
		</ul>
	 </div>
	</div>
</div>
<!-- End Banner Container -->

<main>
  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Clean Code</h5>
					</div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Fast and Minimal</h5>
					</div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to Use</h5>
					</div>
        </div>
      </div>

    </div>
		<!-- End Info Section -->
    <br>

  </div>
	<!-- End Info Container -->
</main>

	<footer class="page-footer blue-grey" id="footer">
	  <div class="container">
	    <div class="row">
	      <div class="col s8">
	        <p class="grey-text text-lighten-4">We are just 2 students doing a project.</p>
	      </div>
	      <div class="col s4">
	      <div class="right">
	        <a style="margin-bottom: 5px" class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#faq">F.A.Q.</a>
	        <a style="margin-bottom: 5px" class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#contact">Contact Us</a>
	      </div>
	      </div>
	    </div>
	  </div>
	  <div class="footer-copyright">
	    <div class="container">
	    Made by <b>//noComment</b>
	    </div>
	  </div>
	</footer>


  <!-- Load Some JS -->
  <script src="js/init.js"></script>
	<script src="js/pages/index.js"></script>

	<!-- material-scrolltop button -->
	<button class="material-scrolltop" type="button"></button>

	<!-- material-scrolltop plugin -->
	<script src="js/plugins/material-scrolltop.js"></script>

	<!-- Initialize material-scrolltop with (minimal) -->
	<script>$('body').materialScrollTop();</script>

	<script>
	function disableSend() {
	//contact form enable button
	function enableBtn(){
	 document.getElementById("send_form").disabled = false;
	 document.getElementById("send_form").className = "deep-orange lighten-1 btn waves-effect waves-light modal-action modal-close";
		}
	function sendform(){
	 Materialize.toast("Contact Form Successfully Sent!", 3000 );
		}
	}
	</script>

	<script>
	//onload listener
	window.onload = function loadall(){
		ajaxmaterialize();
		disableSend();
		preloader.off();
	};

	</script>

  </body>
  </html>
