<?php
session_start();
include ("php_includes/db_config.php");
if(isset($_SESSION["id_user"])){
  $sess_name = $_SESSION["id_user"];
  $sql="SELECT * FROM user WHERE id_user='$sess_name' LIMIT 1";
  $result=mysqli_query($connect,$sql);
  $row=mysqli_fetch_array($result);
  if($row['admin']!=1){
    header("Location: main.php");
    exit();
  }
}
elseif(!isset($_SESSION["id_user"])){
  header("Location: index.php");
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Admin Dashboard - VTS Rent-A-Car</title>

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

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

  <!-- EAGER  -->
  <script src="//fast.eager.io/w1gPT0mhb2.js"></script>

  <!-- CSS  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/custom.css" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/datedropper.css">
  <link rel="stylesheet" type="text/css" href="css/timedropper.css">
  <link rel="stylesheet" type="text/css" href="css/material-scrolltop.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">

  <!-- JavaScript Before -->
  <script type="text/javascript" src="js/plugins/materialize.min.js"></script>
  <script type="text/javascript" src="js/plugins/datedropper.js"></script>
  <script type="text/javascript" src="js/plugins/timedropper.js"></script>
  <script type="text/javascript" src="js/plugins/sweetalert2.js"></script>
  <script type="text/javascript" src="js/register.js"/> </script>


</head>

<body onload="adminLoadAll()">
  <nav class="blue-grey" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Admin Dashboard</a>
		  <!-- Desktop Navigation -->

      <ul class="right hide-on-med-and-down">
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="main.php" >MAIN</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#insert_car" >Insert Car</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#profile" id="bprofile" onclick="Materialize.toast('Press UPDATE to update your profile.', 4000)">Profile</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>

      <!-- Mobile Navigation -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="main.php" >MAIN</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#insert_car" >Insert Car</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn modal-trigger" href="#profile">Profile</a></li>
        <li><a class="deep-orange lighten-1 waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<!-- Include Modals -->
<?php include("include/admin_modals.html");?>

<main>
<div class="container">
<div class="section"> <!-- Opening Car Section -->

  <!-- Cars Load With This -->
  <div class="row">
    <div class="col s12">
      <ul class="tabs z-depth-2">
        <li class="tab col s3"><a href="#cars_tab">Cars</a></li>
        <li class="tab col s3"><a href="#users_tab">Users</a></li>
      </ul>
    </div>
        <!-- Car Select Section -->
        <div id="cars_tab" class="col l12 m12 s12"><br />
         <div class="center">
           <div class="input-field"> <!-- SEARCH -->
             <input id="search" type="search" data-toggle="hideseek" required data-list=".list">
             <label for="search">Search</label>
           </div>
            <div class="input-field col l12 m12 s12">
              <select id="cars" onchange="adminShow()">
                <option value="all">All Cars</option>
                <option value="rented">Rented</option>
                <option value="free">Free</option>
              </select>
            </div>
         </div>
         <ul class="staggered-list list" id="staggered-test"></ul>
      </div>

      <!-- USER Select Section -->
      <div id="users_tab" class="col l12 m12 s12" > <br />
      <div class="center">
        <div class="input-field"> <!-- SEARCH -->
          <input id="search" type="search" data-toggle="hideseek" required data-list=".list">
          <label for="search">Search</label><br />
        </div>
      </div>
        <div class="collection list" id="userDisplay">
        </div>
      </div>

  </div>

</div>
</div>

</main>

<footer class="page-footer blue-grey" id="footer">
  <div class="container">
    <div class="row">
      <div class="col s12">
        <p class="grey-text text-lighten-4">We are just 2 students doing a project.</p>
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
  <script src="js/pages/admin.js"></script>
  <script src="js/plugins/jquery.hideseek.min.js"></script>

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
      adminLoadAll();
      profileAjax();
      Materialize.toast("Welcome Admin", 2000 );
    };
  </script>
