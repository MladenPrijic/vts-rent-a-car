<?php
session_start();

if(isset($_SESSION["id_user"])){
  $sess_name = $_SESSION["id_user"];
}  ?>

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

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

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
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Admin Dashboard</a>
		  <!-- Desktop Navigation -->
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#insert_car">Insert Car</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#profile" id="bprofile" onclick="Materialize.toast('Press UPDATE to update your profile.', 4000)">Profile</a></li>
        <li><a class="waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>

      <!-- Mobile Navigation -->
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#insert_car">Insert Car</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#profile">Profile</a></li>
        <li><a class="waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

<div id="profile" class="modal"> <!-- START PROFILE MODAL -->
  <div class="modal-content">
  <h4>Profile</h4>
  <span id="error"></span>
  <p>You can change your info here.</p>
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
          <input id="username" name="username" type="text" class="validate" >
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
          <label for="last_name">Email</label>
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
    <button class="btn waves-effect waves-light" type="submit" name="action" onclick="update()">Update
    <i class="material-icons right">send</i>
    </button>
  </div>
</div> <!-- END OF PROFILE -->


<div id="insert_car" class="modal"> <!-- Insert Car Modal -->
<div class="modal-content">
  <h4>Add a car</h4>
  <span id="error"></span>
  <div class="row">
    <form name="register" onclick="return false;" class="col s12">
      <div class="row">
        <div class="input-field col l4 m4 s6">
          <input id="brand" name="brand" type="text" class="validate">
          <label for="brand">Brand</label>
        </div>
        <div class="input-field col l4 m4 s6">
          <input id="model" name="model"  type="text" class="validate">
          <label for="model">Model</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input id="image" name="image" type="text" class="validate">
          <label for="image">Image</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l6 m6 s6">
          <input id="Year" name="Year" type="number" class="validate">
          <label for="Year">Year</label>
        </div>
        <div class="input-field col l6 m6 s6">
          <select id="location">
            <option value="choose" disabled selected>Choose a Location</option>
            <option value="subotica">Subotica</option>
            <option value="novi_sad">Novi Sad</option>
            <option value="beograd">Beograd</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l2 m2 s6">
          <p class="range-field">Seats
            <input type="range" id="seats" min="3" max="7" value="3" />
          </p>
        </div>
        <div class="input-field col l2 m2 s6">
          <p class="range-field">Doors
            <input type="range" id="doors" min="3" max="5" value="3" />
          </p>
        </div>
        <div class="input-field col l2 m2 s6">
          <p class="range-field">Luggage
            <input type="range" id="luggage" min="0" max="10" value="0" />
          </p>
        </div>
        <div class="input-field col l2 m2 s6">
          <p class="range-field">A/C
            <input type="range" id="ac" min="0" max="1" value="0" />
          </p>
        </div>
        <div class="input-field col l2 m2 s6">
          <p class="range-field">Automatic
            <input type="range" id="automatic" min="0" max="1" value="0" />
          </p>
        </div>
        <div class="input-field col l2 m2 s6">
          <p class="range-field">Navigation
            <input type="range" id="navigation" min="0" max="1" value="0" />
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l12 m12 s12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="description" class="materialize-textarea"></textarea>
          <label for="description">Description</label>
        </div>
      </div>
    </form>
</div>
</div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
    <button class="btn waves-effect waves-light" type="submit" name="action" onclick="insert_car()">Insert
    <i class="material-icons right">send</i>
    </button>
  </div>
</div> <!-- END OF INSER-CARS -->



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
            <div id="cars_tab" class="col l12 m12 s12">
             <div class="center">
                <div class="input-field col l12 m12 s12">
                      <br /><br />
                  <select id="cars" onchange="adminShow()">
                    <option value="all">All Cars</option>
                    <option value="rented">Rented</option>
                    <option value="free">Free</option>
                  </select>
                </div>
             </div>
             <ul class="staggered-list" id="staggered-test"></ul>
          </div>


                <!-- Car Select Section -->

      <div id="users_tab" class="col l12 m12 s12" >
        <br /><br />
        <div class="collection">
          <a href="#user_modal" class="collection-item modal-trigger">Alvin<span class="badge">click me</span></a>
          <a href="#!" class="collection-item">Alvin<span class="badge">renting (car name)</span></a>
          <a href="#!" class="collection-item">Alvin</a>
          <a href="#!" class="collection-item">Alvin</a>
          <a href="#!" class="collection-item">Alvin</a>
          <a href="#!" class="collection-item">Alvin</a>
          <a href="#!" class="collection-item">Alvin</a>
        </div>
      </div>

  </div>

</div>
</div>

<div id="user_modal" class="modal"> <!-- START USER MODAL -->
  <div class="modal-content">
  <h4>(name of user)'s' Profile</h4>
  <span id="error"></span>
  <p>You can change (name of user) info here.</p>
  <div class="row">
    <form name="register" onclick="return false;" class="col s12">
      <div class="row">
        <div class="input-field col l4 m4 s6">
          <input id="user_fName" name="user_fName" type="text" class="validate">
          <label for="user_fName">First Name</label>
        </div>
        <div class="input-field col l4 m4 s6">
          <input id="user_lName" name="user_lName"  type="text" class="validate">
          <label for="user_lName">Last Name</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input id="user_username" name="user_username" type="text" class="validate" >
          <span id="check_name" ></span> <!--change to popup -->
          <label for="user_username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="user_phone" name="user_phone" type="number" class="validate">
          <label for="user_phone">Phone</label>
        </div>
        <div class="input-field col s6">
          <input id="user_email" name="user_email" type="text" class="validate" onkeyup="limit('email')">
          <label for="last_name">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col l3 m3 s6">
          <input id="user_street" name="user_street" type="text" class="validate">
          <label for="user_street">Address</label>
        </div>
        <div class="input-field col l3 m3 s6">
          <input id="user_city" name="user_city" type="text" class="validate">
          <label for="user_city">City</label>
        </div>
        <div class="input-field col l3 m3 s6">
          <input id="user_zip" name="user_zip" type="number" class="validate">
          <label for="user_zip">Zip</label>
        </div>
        <div class="input-field col l3 m3 s6">
          <input id="user_country" name="user_country" type="text" class="validate">
          <label for="user_country">Country</label>
        </div>
      </div>
    </form>
  </div>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
    <button class="btn waves-effect waves-light" type="submit" name="action" onclick="user_update()">Update
    <i class="material-icons right">send</i>
    </button>
  </div>
</div> <!-- END OF USER -->





<footer class="page-footer orange" id="footer">
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
  <script src="js/getData.js"></script>
  <script src="js/init.js"></script>


  <!-- material-scrolltop button -->
  <button class="material-scrolltop" type="button"></button>

  <!-- material-scrolltop plugin -->
  <script src="js/plugins/material-scrolltop.js"></script>

  <!-- onload all cars -->
  <script src="js/all_onload.js"></script>

  <!-- select id="cars" for looking at all, rented and free cars -->
  <script src="js/admin.js"></script>

  <!-- Initialize material-scrolltop -->
  <script>$('body').materialScrollTop();</script>

</body>
</html>

  <script type="text/javascript">
  // AJAX for Profile Update
  document.getElementById("bprofile").addEventListener('click',myFunction); //event listener for the profile button

  var xmlhttp = new XMLHttpRequest();
  var url = "main_get_ajax.php";

  xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          myFunction(xmlhttp.responseText); } };

  xmlhttp.open("GET", url, true);
  xmlhttp.send();

  function myFunction(response) {
    arr = JSON.parse(response);

    document.getElementById("fName").value = arr[0];
    document.getElementById("lName").value = arr[1];
    document.getElementById("username").value = arr[2];
    document.getElementById("phone").value = arr[3];
    document.getElementById("email").value = arr[4];
    document.getElementById("street").value = arr[5];
    document.getElementById("city").value = arr[6];
    document.getElementById("zip").value = arr[7];
    document.getElementById("country").value = arr[8];

    $(document).ready(function() {
    Materialize.updateTextFields();
    }); }


  function ajaxObj( meth, url ) {
    var x = new XMLHttpRequest();
    x.open( meth, url, true );
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  return x; }

  function ajaxReturn(x) {
    if(x.readyState == 4 && x.status == 200){
      return true; } }

  function _(x) {
    return document.getElementById(x); }

  </script>

  <script>
  //onload listener
  window.onload = function loadall(){
    adminLoadAll();
    Materialize.toast("Welcome Admin", 2000 );
  //  Materialize.showStaggeredList("#staggered-test"); //not needed, loaded with each ajax instead
  };
  </script>
