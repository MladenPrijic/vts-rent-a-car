function namePopup() {
//AJAX For Name Popup At Start
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
	Materialize.toast("Welcome "+ arr[0], 2000 );


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

} }


function info(car_num) {

    var id_car = car_num;

    var ajaxx=ajaxObj("POST","php_includes/rent.php");
    ajaxx.onreadystatechange=function(){
      if(ajaxReturn(ajaxx)){
        var jason=JSON.parse(ajaxx.responseText);

         var priceDay=jason[0]['price_day'];
         var priceFlat=jason[0]['price_flat'];
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

    function calculate(pricef,priced) {
      calc = 0;
      diff = 0;
      if (rdate_month == pdate_month) {
        diff = rdate_day - parseInt(pdate_day) + 1;
        justdoit(pricef,priced)
      } else if ( rdate_month == parseInt(pdate_month) + 1 ) {
        diff = parseInt(rdate_day) + 30 - parseInt(pdate_day) + 1;
        justdoit(pricef,priced)
      } else {
        Materialize.toast("You CAN'T Rent a car for more then a month at a time.", 3000 );
      }

      function justdoit(flat,day) {
        calc = parseInt(flat) + (parseInt(day) * diff);
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
    calculate(priceFlat,priceDay);

		//sweetalert2
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
      if(isConfirm === true){

		  var ajax=ajaxObj("POST","php_includes/rent.php");
		  ajax.onreadystatechange=function(){
		    console.log(ajax.responseText);
		      if(ajax.responseText == 2){
		        swal(
		          'Confirmed!',
		          'Your order has been accepted ＼（＾ ＾）／',
		          'success' ); }
		  		else if(ajax.responseText == 1){
		        swal(
		          'Cancelled',
		          'You are already renting a car! Check the Car section to see more. .·´¯`(>▂<)´¯`·.',
		          'error' ); } }
						ajax.send("id_car="+id_car+"&pickupCity="+city_pickup+"&returnCity="+city_return+"&pickupDate="+pdate+"&returnDate="+rdate+"&price="+calc); }
		  		else if (isConfirm === false) {
					  swal(
					    'Cancelled',
					    'Your order has been Cancelled .·´¯`(>▂<)´¯`·.',
					    'error' ); } }); } } }
		    		ajaxx.send("getprice="+id_car); }
