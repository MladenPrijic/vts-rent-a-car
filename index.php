<?php
session_start();

if(isset($_SESSION["id_user"])){
	header("Location: main.php");
}
?>

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

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<!-- CSS  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/custom.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/material-scrolltop.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="css/materialPreloader.min.css">

</head>
<body>

	<!-- JavaScript Before -->
	<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
  <script type="text/javascript" src="js/plugins/materialize.min.js"></script>
  <script type="text/javascript" src="js/plugins/sweetalert2.js"></script>
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

  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">VTS Rent-A-Car</a>
		  <!-- Desktop Navigation -->
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#signup">Sign Up</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#login">Login</a></li>
      </ul>
      <!-- Mobile Navigation -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#signup">Sign Up</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#login">Login</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<!-- Modal Structure -->
<div id="signup" class="modal"> <!-- Start Signup Modal -->
	  <div class="modal-content">
	    <h4>Sign Up</h4>
	    <span id="error"></span>
	    <p>We need a lot of data for remarketing purposes, so please fill all of these in :) We sell your data to 3rd parties.</p>
	    <div class="row">
	  <form name="register" onclick="return false;" class="col s12">
	    <div class="row">
	      <div class="input-field col l4 m4 s6">
	        <input id="fName" name="fName" type="text" class="validate">
	        <label for="fName">First Name</label>
	      </div>
	      <div class="input-field col l4 m4 s6">
	        <input id="lName" name="lName"  type="text" class="validate">
	        <label for="lName">Last Name</label>
	      </div>
	      <div class="input-field col l4 m4 s12">
	        <input id="username" name="username" type="text" class="validate" onkeyup="limit('username')" onblur="check_username()">
	        <span id="check_name" ></span> <!--change to popup -->
	        <label for="username">Username</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col s6">
	        <input id="phone" name="phone" type="number" class="validate">
	        <label for="phone">Phone</label>
	      </div>
	      <div class="input-field col s6">
	        <input id="email" name="email" type="text" class="validate" onkeyup="limit('email')">
	        <label for="email">Email</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col s6">
	        <input id="password" name="password" type="password" class="validate">
	        <label for="password">Password</label>
	      </div>
	      <div class="input-field col s6">
	        <input id="confirm_password" name="confirm_password" type="password" class="validate">
	        <label for="password">Repeat Password</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col l3 m3 s6">
	        <input id="street" name="street" type="text" class="validate">
	        <label for="street">Address</label>
	      </div>
	      <div class="input-field col l3 m3 s6">
	        <input id="city" name="city" type="text" class="validate">
	        <label for="city">City</label>
	      </div>
	      <div class="input-field col l3 m3 s6">
	        <input id="zip" name="zip" type="number" class="validate">
	        <label for="zip">Zip</label>
	      </div>
	      <div class="input-field col l3 m3 s6">
	        <input id="country" name="country" type="text" class="validate">
	        <label for="country">Country</label>
	      </div>
	    </div>
	  </form>
	</div>
	</div>
  <div class="modal-footer">
	    <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
			<a class="waves-effect waves-light btn" style="margin-left: 5px; margin-right: 5px" onClick="random();">Populate Forms <i class="material-icons right">input</i></a>
	    <button class="btn waves-effect waves-light" type="submit" name="action" onclick="signup()">Sign Up
	    <i class="material-icons right">send</i>
	  	</button>
  </div>
</div> <!-- End Signup Modal -->

<div id="login" class="modal"> <!-- Start Login Modal -->
  <div class="modal-content">
	    <h4>Login</h4>
	    <p>Fill in your login info.</p>
			<p><?php if(isset($_GET["error"])){ echo "Wrong username or password!"; } ?></p> <!-- Display Error -->
  	<form action="login.php" method="post" class="col s12">
	    <div class="row">
	      <div class="input-field col s12">
	        <input id="login_username" name="login_username" type="text" class="validate" onblur="check_name()">
	        <label for="login_username">Username</label>
	      </div>
	    </div>
	    <div class="row">
	      <div class="input-field col s12">
	        <input id="login_password" name="login_password" type="password" class="validate">
	        <label for="login_password">Password</label>
	      </div>
			<label style="margin-left: 12px"><a class="modal-trigger" href="#forgot" >Forgot Password?</a></label>
	    </div>
	</div>
	  <div class="modal-footer">
	    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	    <button class="btn waves-effect waves-light" type="submit">Login
	    <i class="material-icons right">send</i>
	  	</button>
	  </div>
	</form>
</div> <!-- End Login Modal -->

<div id="forgot" class="modal"> <!-- Start Forgot Password Modal -->
  <div class="modal-content">
	    <h4>Noob</h4>
	    <p>Username and Email please.</p>
  	<form action="forgot.php" method="post" class="col s12">
	    <div class="row">
	      <div class="input-field col s12">
	        <input id="forgot_username" name="forgot_username" type="text" class="validate">
	        <label for="forgot_username">Username</label>
	      </div>
	    </div>
	    <div class="row">
				<div class="input-field col s12">
	        <input id="email" name="email" type="text" class="validate">
	        <label for="email">Email</label>
	      </div>
	    </div>
	</div>
	  <div class="modal-footer">
	    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	    <button class="btn waves-effect waves-light" type="submit">Request New Password
	    <i class="material-icons right">send</i>
	  	</button>
	  </div>
	</form>
</div> <!-- End Forgot Password Modal -->

<div class="container"> <!-- Start Banner Container -->
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
</div> <!-- End Banner Container -->



  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div> <!-- End Info Section -->
    <br>

  </div> <!-- End Info Container -->

	<footer class="page-footer orange" id="footer">
	  <div class="container">
	    <div class="row">
	      <div class="col s10">
	        <p class="grey-text text-lighten-4">We are just 2 students doing a project.</p>
	      </div>
	      <div class="col s2">
	        <a class="waves-effect waves-light btn modal-trigger" href="#contact">Contact Us</a>
	      </div>
	    </div>
	  </div>
	  <div class="footer-copyright">
	    <div class="container">
	    Made by <b>//noComment</b>
	    </div>
	  </div>
	</footer>

	<div id="contact" class="modal"> <!-- Contact Form Modal -->
	  <div class="modal-content">
	    <h4>Contact</h4>
	    <p>Please fill out the contact form.</p>
				  <form class="col s12">
				    <div class="row">
				      <div class="input-field col s6">
				        <i class="material-icons prefix">account_circle</i>
				        <input id="contact_firstname" type="text" class="validate">
				        <label for="contact_firstname">First Name</label>
				      </div>
				      <div class="input-field col s6">
				        <i class="material-icons prefix">account_circle</i>
				        <input id="contact_lastname" type="text" class="validate">
				        <label for="contact_lastname">Last Name</label>
				      </div>
				    </div>
				    <div class="row">
				      <div class="input-field col s12 m6 l6">
								<i class="material-icons prefix">email</i>
				        <input id="contact_email" type="email" class="validate">
				        <label for="contact_email">Email</label>
				      </div>
							<div class="col s12 m6 l6">
								<!-- Google ReCaptcha -->
								<div class="g-recaptcha" data-callback="enableBtn" data-sitekey="6Ldnvh4TAAAAAH4pPWBOI6FxhLTDHC3e2fq8DH_n"></div>

							</div>
				    </div>
				    <div class="row">
				      <div class="input-field col s12">
				        <i class="material-icons prefix">mode_edit</i>
				        <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
				        <label for="icon_prefix2">Message</label>
				      </div>
				    </div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
							<button class="btn waves-effect waves-light disabled" id="send_form" type="submit" onclick="sendform()" disabled>Submit
							<i class="material-icons right">send</i>
						</button>
						</div>
				  </form>
		</div>
	</div>

  <script src="js/init.js"></script>

	<!-- material-scrolltop button -->
	<button class="material-scrolltop" type="button"></button>

	<!-- material-scrolltop plugin -->
	<script src="js/plugins/material-scrolltop.js"></script>

	<!-- Initialize material-scrolltop with (minimal) -->
	<script>$('body').materialScrollTop();</script>

	<script>
	//contact form enable button
	function enableBtn(){
	 document.getElementById("send_form").disabled = false;
	 document.getElementById("send_form").className = "btn waves-effect waves-light modal-action modal-close";
	}
	function sendform(){
	 event.preventDefault();
	 Materialize.toast("Contact Form Successfully Sent!", 3000 );
	}
	</script>

	<script>
	//onload listener
	window.onload = function loadall(){
		ajaxmaterialize(); //loads the scrips needed for materialize to run correctly; trying to force the DRY programming rule; located inside init.js
		preloader.off();
	};

	</script>

  </body>
  </html>
