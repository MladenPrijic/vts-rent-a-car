(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

// Material Design OnLoad stuff
$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal-trigger').leanModal();
});

$(document).ready(function() {
$('select').material_select();
});


function ajaxmaterialize() {
  Materialize.showStaggeredList("#staggered-test");
  $(document).ready(function(){
  $('.tooltipped').tooltip({delay: 50});
  });
  document.getElementById("footer").style.display = "block";
  //preloader.off();
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
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

    function calculate() {
      calc = 0;
      diff = 0;
      if (rdate_month == pdate_month) {
        diff = rdate_day - pdate_day + 1;
        justdoit()
      } else if ( rdate_month == parseInt(pdate_month) + 1 ) {
        diff = parseInt(rdate_day) + 30 - pdate_day + 1;
        justdoit()
      } else {
        Materialize.toast("You CAN'T Rent a car for more then a month at a time.", 3000 );
      }

      function justdoit() {
        calc = 70 + 10 * diff; //treba staviti da ovde bude cena auta flat + po danu
        console.log(calc);
        Materialize.toast("Your order is $"+calc, 6000 ); }
      }


    var city_pickup=document.getElementById('city_pickup').value;
    var city_return=document.getElementById('city_return').value;


    if (pdate == '--' || rdate == '--' || city_pickup == 'choose' || city_return=='choose' || pdate > rdate || (ptime > "20:00" || ptime < "08:00") || (rtime > "20:00" || rtime < "08:00")) {
    if (pdate == '--') { Materialize.toast("Please Select a Departure Date", 3000 ); } else if (ptime > "20:00" || ptime < "08:00") { Materialize.toast("Please select a time between 08:00 and 20:00", 3000 ); }
    if (rdate == '--') { Materialize.toast("Please Select a Return Date", 3000 ); } else if (rtime > "20:00" || rtime < "08:00") { Materialize.toast("Please select a time between 08:00 and 20:00", 3000 ); }
    else if (pdate > rdate) { Materialize.toast("Return Date can't be before Departure Date", 3000 ); }
    //else if ((pdate == ptime) && rtime - ptime !> 4)
    if(city_pickup == 'choose' || city_return=='choose'){
    if(city_pickup=='choose'){Materialize.toast("Please Select a city for pickup", 3000 );}
    if(city_return=='choose'){Materialize.toast("Please Select a city for return", 3000 );} } }
    else {
    pdate += " " + ptime + ":00"
    rdate += " " + rtime + ":00"
    console.log("City for pickup: " +city_pickup );
    console.log("City for return: " +city_return );
    console.log("Pickup Date: "+pdate);
    console.log("Return Date: "+rdate);
    calculate();
    /////////////////////////////////////////////////////////
    // var ajaxx=ajaxObj("POST","php_includes/rent.php");
    //     ajaxx.onreadystatechange=function(){
    //       if (ajaxReturn(ajaxx) === true) {
    //         //console.log(ajax.returnText);
    //         Materialize.toast(ajaxx.responseText, 3000 );

    //       }
    //     }
    //     ajaxx.send("id_car="+id_car+"&pickupCity="+city_pickup+"&returnCity="+city_return+"&pickupDate="+pdate+"&returnDate="+rdate);

    ///////////////////////////////
    swal({
      title: 'Are you sure?',
      text: "Your order of $"+ calc +" will be captured!",
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

        var ajax=ajaxObj("POST","php_includes/rent.php");
        ajax.onreadystatechange=function(){
          if (ajaxReturn(ajax) === true) {
            if(ajax.responseText == 2){
              swal(
          'Confirmed!',
          'Your order has been accepted ＼（＾ ＾）／',
          'success'
        );
            }
            else if(ajax.responseText == 1){
              swal(
          'Cancelled',
          'You are already renting a car! Check the Car section to see more. .·´¯`(>▂<)´¯`·.',
          'error'
        );
            }

            }

          }

        ajax.send("id_car="+id_car+"&pickupCity="+city_pickup+"&returnCity="+city_return+"&pickupDate="+pdate+"&returnDate="+rdate);


    });

  }

}

//populate forms function
function random() {
  var randname = chance.first();
  document.register.fName.value = randname;
  document.register.lName.value = chance.last();
  document.register.username.value = randname;

  document.register.phone.value = chance.string({length: 9, pool: '1234567890'});
  document.register.email.value = chance.email();


  document.register.password.value = "password";
  document.register.confirm_password.value = "password";

  document.register.street.value = chance.address();
  document.register.city.value = chance.city();
  document.register.zip.value = chance.zip();
  document.register.country.value = chance.country({ full: true });

  $(document).ready(function() {
  Materialize.updateTextFields();
  });

  Materialize.toast("Password is: password", 6000 );
}
