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

<body onload="init()"> <!-- Loading the init function located inside init.js -->

  <nav class="blue-grey" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" onclick="init()" class="brand-logo" style="cursor: pointer;">Dashboard</a>
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
<!-- MODAL STRUCTURE -->
<div id="profile" class="modal modal-fixed-footer">
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
      <div class="row">
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
        <label style="margin-left: 12px"><a class="modal-trigger" href="#change_password_modal" >Change Password</a></label>
      </div>
    </form>
  </div>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
    <button class="deep-orange lighten-1 btn waves-effect waves-light" type="submit" name="action" onclick="update()">Update
    <i class="material-icons right">send</i>
  </button>
  </div>
</div> <!-- END OF PROFILE -->

<!-- PASSWORD MODAL STRUCTURE -->
<div id="change_password_modal" class="modal bottom-sheet modal-fixed-footer">
  <div class="modal-content">
  <span id="error"></span>
  <div class="row">
    <form name="change_password" onclick="return false;" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="current_password" name="current_password" type="password" class="validate">
          <label for="current_password">Current Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="change_password" name="change_password" type="password" class="validate">
          <label for="change_password">New Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="confirm_password" name="confirm_password" type="password" class="validate">
          <label for="confirm_password">Repeat Password</label>
        </div>
      </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
    <button style="margin-right: 5px" class="deep-orange lighten-1 btn waves-effect waves-light"  name="action" onclick="passChange(<?php echo $sess_name; ?> )">Change Password
    <i class="material-icons right">send</i>
  </button>
  </div>
</div> <!-- CHANGE PASSWORD -->

<!-- MODAL CAR STRUCTURE -->
<div id="cars" class="modal">
  <div class="modal-content">
  <h4>Cars</h4>
  <div class="row">
    <ul class="collapsible" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons">info_outline</i>Currently Renting</div>
      <div class="collapsible-body">
        <ul id="userData">

        </ul>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">receipt</i>History</div>
      <div class="collapsible-body">
      <div class="row">
        <form class="col s12" onclick="return false;">
          <div class="row" id="userFeedback">

          </div>
        </form>
      </div>
    </div>


  </li>
  </ul>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>
</div> <!-- END OF CAR -->

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
          <select id="city_pickup" onchange="getData()">
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

  <div id="contact" class="modal"> <!-- START CONTACT MODAL -->
    <div class="modal-content">
      <h4>Contact</h4>
      <p>Please fill out the contact form.</p>
          <form class="col s12" onclick="return false;">
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
              <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">email</i>
                <input id="contact_email" type="email" class="validate">
                <label for="contact_email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <textarea id="contact_message" class="materialize-textarea" length="600"></textarea>
                <label for="icon_prefix2">Message</label>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
              <button class="btn waves-effect waves-light " id="send_form" type="submit" onclick="sendform()" >Submit
              <i class="material-icons right">send</i>
            </button>
            </div>
          </form>
    </div>
  </div> <!-- END CONTACT MODAL -->

  <div id="faq" class="modal"> <!-- START F.A.Q. MODAL -->
    <div class="modal-content">
      <h4>Frequently Asked Questions.</h4>
        <ul class="collapsible popout" data-collapsible="expandable">
          <li>
            <div class="collapsible-header">What cities do you offer?</div>
            <div class="collapsible-body">
              <p>Currently we offer our services in the following cities below and more are on the way.</p>
                <ul style="padding-left: 20px" class="collection">
                  <li class="collection-item"> - Subotica</li>
                  <li class="collection-item"> - Novi Sad</li>
                  <li class="collection-item"> - Beograd</li>
                </ul>
            </div>
          </li>
          <li>
            <div class="collapsible-header">How long did it take to make this?</div>
            <div class="collapsible-body"><p>Around 80+ combined hours.</p></div>
          </li>
          <li>
            <div class="collapsible-header">I don't even know.</div>
            <div class="collapsible-body"><p>Yes.</p></div>
          </li>
        </ul>
    </div>
  </div> <!-- END F.A.Q. MODAL -->

  <!-- JavaScript After -->
  <script src="js/getData.js"></script>
  <script src="js/init.js"></script>

  <!-- Datedropper and Timedropper Scripts -->
  <script>$( "#departure_pickup" ).dateDropper();</script>
  <script>$( "#departure_return" ).dateDropper();</script>
  <script>$( "#alarm_pickup" ).timeDropper();</script>
  <script>$( "#alarm_return" ).timeDropper();</script>

  <!-- material-scrolltop button -->
  <button class="material-scrolltop" type="button"></button>

  <!-- material-scrolltop plugin -->
  <script src="js/plugins/material-scrolltop.js"></script>

  <!-- onload random cars -->
  <script src="js/random_onload.js"></script>

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
    $('alarm_pickup').innerHTML = +3;
    init();
    Materialize.toast("Welcome "+ arr[0], 2000 );
  };
  </script>
