<?php
session_start();
include("php_includes/db_config.php");
if(isset($_SESSION["id_user"])){
  $sess_name = $_SESSION["id_user"];
}
elseif(!isset($_SESSION["id_user"])){
  header("Location: index.php");
  }
  $sql="SELECT * FROM user WHERE id_user='$sess_name' LIMIT 1";
  $result=mysqli_query($connect,$sql);
  $row=mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Dashboard - VTS Rent-A-Car</title>

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
  <link rel="stylesheet" type="text/css" href="css/datedropper.css">
  <link rel="stylesheet" type="text/css" href="css/timedropper.css">
  <link rel="stylesheet" type="text/css" href="css/material-scrolltop.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="css/materialPreloader.min.css">

  <!-- JavaScript Before -->
  <script type="text/javascript" src="js/plugins/materialize.min.js"></script>
  <script type="text/javascript" src="js/plugins/datedropper.js"></script>
  <script type="text/javascript" src="js/plugins/timedropper.js"></script>
  <script type="text/javascript" src="js/plugins/sweetalert2.js"></script>
  <script type="text/javascript" src="js/plugins/materialPreloader.min.js"></script>
  <script type="text/javascript" src="js/register.js"/> </script>


</head>

<body>

  <nav class="blue-grey" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" onclick="random_cars()" class="brand-logo" style="cursor: pointer;">Dashboard</a>
      <!-- Desktop Navigation -->
      <ul class="right hide-on-med-and-down">
      <?php if($row["admin"] ==1 ){ ?>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="admin.php" >ADMIN</a></li>
        <?php } ?>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#cars" onclick="showUserData(<?php echo $sess_name; ?> )">Cars</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#profile" id="bprofile">Profile</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>
      <!-- Mobile Navigation -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="admin.php" >ADMIN</a></li> <!-- HIDDEN IF THE USER ISN'T AN ADMIN -->
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#cars">Cars</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#profile">Profile</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<!-- Include Modals -->
<?php include("include/main_modals.html");?>

<main>

<div class="container">
  <div class="section">

  <div class="row"> <!-- Opening Row For Description and Inputs -->
    <div class="col s12 m6"> <!-- Pickup Section -->
      <!--   Icon Section   -->
      <div class="icon-block">
        <h2 class="center light-blue-text"><i class="material-icons">today</i<i class="material-icons">schedule</i><i class="material-icons">call_received</i><i class="material-icons">location_on</i></h2>
        <h5 class="center">Pick Up Location</h5><br />
        <div class="center">

        <div class="input-field col l6 m12 s12">
          <select id="city_pickup" onchange="city_car()">
            <option value="choose" disabled selected>Choose your City</option>
            <option value="Subotica">Subotica</option>
            <option value="Novi Sad">Novi Sad</option>
            <option value="Beograd">Beograd</option>
          </select>
        </div>

        <!-- Select the date and time, limited to current year + 4 -->
        <input class="deep-orange lighten-1 waves-effect waves-light btn-large" style="margin-top: 10px; width: 150px" placeholder="Select a date" type="text" id="departure_pickup" />
        <input class="deep-orange lighten-1 waves-effect waves-light btn-large" style="margin-top: 10px; width: 100px" type="text" id="alarm_pickup" />
        </div>
      </div>
    </div>

    <div class="col s12 m6"> <!-- Return Section -->
      <div class="icon-block">
        <h2 class="center light-blue-text"><i class="material-icons">today</i<i class="material-icons">schedule</i><i class="material-icons">call_made</i><i class="material-icons">location_off</i></h2>
        <h5 class="center">Return Location</h5><br />
        <div class="center">

          <div class="input-field col l6 m12 s12">
            <select id="city_return">
              <option value="choose" disabled selected>Choose your City</option>
              <option value="Subotica">Subotica</option>
              <option value="Novi Sad">Novi Sad</option>
              <option value="Beograd">Beograd</option>
            </select>
          </div>

        <!-- Select the date and time, limited to current year + 4 -->
        <input class="deep-orange lighten-1 waves-effect waves-light btn-large" style="margin-top: 10px; width: 150px" placeholder="Select a date" type="text" id="departure_return" />
        <input class="deep-orange lighten-1 waves-effect waves-light btn-large" style="margin-top: 10px; width: 100px" type="text" id="alarm_return" />
        </div>
     </div>
    </div>

  </div> <!-- Closing Row For Description and Inputs -->

</div> <!-- Closing Main Section -->


<div class="section"> <!-- Opening Car Section -->

  <!-- Cars Load With This -->
  <ul class="staggered-list" id="staggered-test"></ul>

</div> <!-- Closing Car Section -->
</div> <!-- Closing Main Container -->

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

  <!-- JavaScript After -->
  <script src="js/init.js"></script>
  <script src="js/pages/main.js"></script>

  <!-- Datedropper and Timedropper Scripts -->
  <script>$( "#departure_pickup" ).dateDropper();</script>
  <script>$( "#departure_return" ).dateDropper();</script>
  <script>$( "#alarm_pickup" ).timeDropper();</script>
  <script>$( "#alarm_return" ).timeDropper();</script>

  <!-- material-scrolltop button -->
  <button class="material-scrolltop" type="button"></button>

  <!-- material-scrolltop plugin -->
  <script src="js/plugins/material-scrolltop.js"></script>

  <!-- Initialize material-scrolltop -->
  <script>$('body').materialScrollTop();</script>

</body>
</html>

  <script>
  //onload listener
  window.onload = function loadall(){
    random_cars();
    profileAjax();
    ajaxmaterialize();
    namePopup();
  };
  </script>
