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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/datedropper.css">
  <link rel="stylesheet" type="text/css" href="css/timedropper.css">
  <link rel="stylesheet" type="text/css" href="css/material-scrolltop.css">

  <style>

  #departure_pickup, #departure_return, #alarm_pickup, #alarm_return { border-bottom: 0px; }

  #staggered-test li {
    display:inline-block;
    float: Left;
    width: 50%;
    padding-left: 10px; }

  </style>

  <style>
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0; }
  </style>

  <!-- JavaScript  -->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script src="js/register.js"/> </script>
	<script src="js/login.js"/> </script>
</head>

<body onload="info()">
  <div style="display: none" class="progress" id="preloader">
    <div class="indeterminate"></div>
</div>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Admin Dashboard</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#insert_car">Insert Car</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#profile" id="bprofile" onclick="Materialize.toast('Press UPDATE to update your profile.', 4000)">Profile</a></li>
        <li><a class="waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect waves-light btn modal-trigger" href="#insert_car">Insert Car</a></li>
        <li><a class="waves-effect waves-light btn modal-trigger" href="#profile">Profile</a></li>
        <li><a class="waves-effect waves-light btn" href="logout.php">Logout</a></li>  <!--force logout -->
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
<!-- Modal Structure -->
<div id="profile" class="modal">
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

<!-- Modal Structure -->
<div id="insert_car" class="modal">
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
  <div class="section">

  <!--   Icon Section   -->
  <div class="row">

    <div class="col l12 m12 s12">
              <div class="center">
        <h5 class="center">Cars</h5><br />
        <div class="center">

          <div class="input-field col l12 m12 s12">
            <select id="cars">
              <option value="all">All</option>
              <option value="rented">Rented</option>
              <option value="free">Free</option>
            </select>
          </div>

     </div>
    </div>

  </div>

  </div>
</div>


<div class="section">

  <ul class="staggered-list" id="staggered-test">

  </ul>
</div>

</div>

<div class="row">
</div>
<footer class="page-footer orange">
  <div class="container">
    <div class="row">
      <div class="col s10">
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

  <script src="js/init.js"></script>
  <script>
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
  $(document).ready(function() {
  $('select').material_select();
  });


  $(document).ready(function(){
  $('.tooltipped').tooltip({delay: 50});
  });
  </script>
  <script>
   /* var options = [
     {selector: '#staggered-test', offset: 0, callback: function() {
      Materialize.toast("Welcome", 1500 );
    } },
    {selector: '#staggered-test', offset: 0, callback: function() {
      Materialize.showStaggeredList("#staggered-test");
    } },
  ];
  Materialize.scrollFire(options); */

   //console.log(name);

  window.onload = function loadall(){
    Materialize.toast("Welcome "+ arr[0], 2000 );
    Materialize.showStaggeredList("#staggered-test");
  };

  </script>


  <!-- material-scrolltop button -->
  <button class="material-scrolltop" type="button"></button>

  <!-- material-scrolltop plugin -->
  <script src="js/material-scrolltop.js"></script>

  <!-- Initialize material-scrolltop with (minimal) -->
  <script>
      $('body').materialScrollTop();
  </script>


</body>
</html>
<script type="text/javascript">

    document.getElementById("bprofile").addEventListener('click',function(){myFunction()});
    // document.getElementById("sh_date").addEventListener('click',function(){loadData(2,'show_date')});

    var xmlhttp = new XMLHttpRequest();
    var url = "get_ajax.php";

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            myFunction(xmlhttp.responseText);
        }
    };
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
        });

}

function info(car_num) {

    var id_car = car_num;
    var pdate = document.getElementById('departure_pickup').value;

    var pdate_year = pdate.slice(6, 10);
    var pdate_month = pdate.slice(3, 5);
    var pdate_day = pdate.slice(0, 2);
    var pdate = pdate_year + "-" + pdate_month + "-" + pdate_day;

    var ptime = document.getElementById('alarm_pickup').value;

    var rdate = document.getElementById('departure_return').value;

    var rdate_year = rdate.slice(6, 10);
    var rdate_month = rdate.slice(3, 5);
    var rdate_day = rdate.slice(0, 2);
    var rdate = rdate_year + "-" + rdate_month + "-" + rdate_day;

    var rtime = document.getElementById('alarm_return').value;

    var city_pickup=document.getElementById('city_pickup').value;
    var city_return=document.getElementById('city_return').value;


    if (pdate == '--' || rdate == '--' || city_pickup == 'choose' || city_return=='choose') {
      if (pdate == '--') { Materialize.toast("Please Select a Departure Date", 3000 ); }
      if (rdate == '--') { Materialize.toast("Please Select a Return Date", 3000 ); }
      if(city_pickup == 'choose' || city_return=='choose'){
      if(city_pickup=='choose'){Materialize.toast("Please Select a city for pickup", 3000 );}
      if(city_return=='choose'){Materialize.toast("Please Select a city for return", 3000 );}
      }
    } else {
    pdate += " " + ptime + ":00"
    rdate += " " + rtime + ":00"
    console.log("City for pickup: " +city_pickup );
    console.log("City for return: " +city_return );
    console.log("Pickup Date: "+pdate);
    console.log("Return Date: "+rdate);
    swal({
      title: 'Are you sure?',
      text: "Your order will be captured!",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: 'No, cancel!',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: true,
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function(isConfirm) {
      if (isConfirm === true) {
        var ajax=ajaxObj("POST","php_includes/rent.php");
        ajax.onreadystatechange=function(){
          if (ajaxReturn(ajax) === true) {
            console.log(ajax.returnText);
          }
        }
        ajax.send("id_car="+id_car+"&pickupCity="+city_pickup+"&returnCity="+city_return+"&pickupDate="+pdate+"&returnDate="+rdate);
        swal(
          'Confirmed!',
          'Your order has been accepted ＼（＾ ＾）／',
          'success'
        );
      } else if (isConfirm === false) {
        swal(
          'Cancelled',
          'Your order has been Cancelled .·´¯`(>▂<)´¯`·.',
          'error'
        );
      } else {
        // Esc, close button or outside click
        // isConfirm is undefined
      }
    });

  }

}


</script>
