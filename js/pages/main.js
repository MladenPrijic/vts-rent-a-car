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
		    		ajaxx.send("getprice="+id_car);
			}

//AJAX FOR CITY_CAR
function ajaxObj( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;
	}
}
function _(x){
	return document.getElementById(x);
}
//Loads Cars based on the City
function city_car(){

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

	_("staggered-test").innerHTML="";
	var selekt=_("city_pickup").value;
	var ajax=ajaxObj("POST","php_includes/getJson.php");
	ajax.onreadystatechange=function(){
		if(ajaxReturn(ajax) === true){
				 preloader.off();
			//console.log(ajax.responseText);
			var jason=JSON.parse(ajax.responseText);
			//console.log(jason);
			var i=jason.length;
	        //console.log(i);

	        for(var j=0; j<i; j++){


	        	_("staggered-test").innerHTML+=
	    "<li>"+
	    "<div class='col s12 m6'>"+
       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
         "<input type='hidden' id='"+j+"' value='"+jason[j]['id_car']+" '> "+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason[j]["image"]+"'>"+
         "</div>"+
         "<div class='card-content'>"+
           "<span class='card-title activator grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+' | <span style="color: #29b6f6; weight: bold">$' +jason[j]['price_flat']+' rent + $' +jason[j]['price_day']+' per day'+"</span><i class='material-icons right'>more_vert</i></span>"+
           "<p>"+ jason[j]['description']+"</p>"+
         "</div>"+
         "<div class='card-reveal'>"+
          "<span class='card-title grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+' | <span style="color: #29b6f6; weight: bold">$' +jason[j]['price_flat']+' rent + $' +jason[j]['price_day']+' per day'+"</span><i class='material-icons right'>close</i></span>"+
          "<ul class='collection with-header'>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason[j]['seats']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason[j]['doors']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason[j]['air_conditioning']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason[j]['automatic']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>Yes</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason[j]['luggage']+"</a></div></li>"+
          "</ul>"+
           "<button class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"info( '"+ jason[j]['id_car']+" ' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Choose"+
            "<i class='material-icons left'>done</i></button>"+
         "</div>"+
       "</div>"+
    "</div>"+
    "</li>";

	        }

		}

  ajaxmaterialize();
	}
	ajax.send("select="+selekt);
}

function random_cars(){

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

	_("staggered-test").innerHTML="";
	var ajax=ajaxObj("POST","php_includes/random_test.php");
	ajax.onreadystatechange=function(){

			if(ajaxReturn(ajax) === true){
			preloader.off();
			//console.log(ajax.responseText);
			var jason=JSON.parse(ajax.responseText);
			//console.log(jason);
			var i=jason.length;
	        //console.log(i);
	    for(var j=0; j<i; j++){
	  	_("staggered-test").innerHTML+=
	    "<li>"+
	    "<div class='col s12 m6'>"+
       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
         "<input type='hidden' id='"+j+"' value='"+jason[j]['id_car']+" '> "+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason[j]["image"]+"'>"+
         "</div>"+
         "<div class='card-content'>"+
           "<span class='card-title activator grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+' | <span style="color: #ff7043; weight: bold">$' +jason[j]['price_flat']+' rent + $' +jason[j]['price_day']+' per day'+"</span><i class='material-icons right'>more_vert</i></span>"+
           "<p>"+ jason[j]['description']+"</p>"+
         "</div>"+
         "<div class='card-reveal'>"+
          "<span class='card-title grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+' | <span style="color: #ff7043; weight: bold">$' +jason[j]['price_flat']+' rent + $' +jason[j]['price_day']+' per day'+"</span><i class='material-icons right'>close</i></span>"+
          "<ul class='collection with-header'>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason[j]['seats']+"</a></div></li>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason[j]['doors']+"</a></div></li>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason[j]['air_conditioning']+"</a></div></li>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason[j]['automatic']+"</a></div></li>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>Yes</a></div></li>"+
	           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason[j]['luggage']+"</a></div></li>"+
          "</ul>"+
           "<button class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"info( '"+ jason[j]['id_car']+" ' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Choose"+
            "<i class='material-icons left'>done</i></button>"+
         "</div>"+
       "</div>"+
    "</div>"+
    "</li>";
			}
		}
  ajaxmaterialize(); //loads the scrips needed for materialize to run correctly; trying to force the DRY programming rule; located inside init.js

	}
	ajax.send("some");

}

//Shows the current car of the user and history, so they can make a comment
function showUserData(id_user){
	var id_user=id_user;
	_("userData").innerHTML="";
	var ajax=ajaxObj("POST","php_includes/getUserData.php");
	ajax.onreadystatechange=function(){
		if(ajaxReturn(ajax) == true){

			var jason=JSON.parse(ajax.responseText);
			var obj=typeof jason['current'];

			var i=jason.length;

      if(obj != 'undefined'){
      _("userData").innerHTML=
			    "<li>"+
			    "<div class='col s12 '>"+
		       "<div class='card small hoverable'>"+
		         "<div class='card-image waves-effect waves-block waves-light'>"+
		         "<input type='hidden' id='"+"' value='"+jason['current'][0]['id_car']+" '> "+
		          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason['current'][0]["image"]+"'>"+
		         "</div>"+
		         "<div class='card-content'>"+
		           "<span class='card-title activator grey-text text-darken-4'>"+ jason['current'][0]['brand'] +' ' +jason['current'][0]['model']+' | <span style="color: #ff7043; weight: bold">$' +jason['current'][0]['price_flat']+' rent + $' +jason['current'][0]['price_day']+' per day'+"</span><i class='material-icons right'>more_vert</i></span>"+
		           "<p>"+"</p>"+
		         "</div>"+
		         "<div class='card-reveal'>"+
		          "<span class='card-title grey-text text-darken-4'>"+ jason['current'][0]['brand'] +' ' +jason['current'][0]['model']+' | <span style="color: #ff7043; weight: bold">$' +jason['current'][0]['price_flat']+' rent + $' +jason['current'][0]['price_day']+' per day'+"</span><i class='material-icons right'>close</i></span>"+
		            "<ul class='collection with-header'>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason['current'][0]['citytaken']+"</a></div></li>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason['current'][0]['datetaken']+"</a></div></li>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason['current'][0]['cityreturn']+"</a></div></li>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason['current'][0]['datereturn']+"</a></div></li>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>"+ jason['current'][0]['price_day']+"</a></div></li>"+
			           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason['current'][0]['year']+"</a></div></li>"+
			          "</ul>"+
			         "</div>"+
			       "</div>"+
			    "</div>"+
			  "</li>";
    _("userFeedback").innerHTML=
	 				"<p>Your previous car was the "+jason['history'][0]['brand'] + " "+ jason['history'][0]['model']+", how did you enjoy it?</p>"+
            "<div class="+ "input-field col s12" +">"+
              "<i class="+"'material-icons prefix'"+">mode_edit</i>"+
              "<textarea id="+"icon_prefix2"+" class="+"materialize-textarea"+"></textarea>"+
              "<label for="+"icon_prefix2"+">Message</label>"+
              "<button class="+"'btn waves-effect waves-light'"+"onclick=\"message('"+ jason['history'][0]['id_car']  +"','"+  jason['history'][0]['id_user']+"')\""+ ">Send"+
              "<i class="+"'material-icons right'"+">send</i>"+
            "</button>"+
            "</div>";
								// Had to load it like this so it doesn't refresh the animation :(
								$(document).ready(function(){
								$('.tooltipped').tooltip({delay: 50});
								});
								document.getElementById("footer").style.display = "block";
								//preloader.off();
								$(document).ready(function(){
									$('.modal-trigger').leanModal();
								});
			} else if(obj=='undefined'){
				_("userData").innerHTML="<li><img id="+"image-test"+" class="+"'responsive-img hoverable'"+" src="+"img/error404.png"+"></li>";
				_("userFeedback").innerHTML=
					"<p>Your previous car was the "+jason['history'][0]['brand'] + " "+ jason['history'][0]['model']+", how did you enjoy it?</p>"+
				  "<div class="+ "input-field col s12" +">"+
				  	"<i class="+"'material-icons prefix'"+">mode_edit</i>"+
				  	"<textarea id="+"icon_prefix2"+" class="+"materialize-textarea"+"></textarea>"+
				  	"<label for="+"icon_prefix2"+">Message</label>"+
				  "<button class="+"'btn waves-effect waves-light'"+"onclick=\"message('"+ jason['history'][0]['id_car']  +"','"+  jason['history'][0]['id_user']+"')\""+ ">Send"+
				    "<i class="+"'material-icons right'"+">send</i>"+
				  "</button>"+
				"</div>";
			}
		}
	}
	ajax.send("id_user="+id_user);
}

// Sends a message into the Database
function message(car,user){
	id_user=user;
	id_car=car;
	var message=_("icon_prefix2").value;
	if(message == ""){
		Materialize.toast("Write a message for us!", 3000 );
	}
	else{
	var ajax=ajaxObj("POST","php_includes/getUserData.php");
	ajax.onreadystatechange=function(){
		if(ajaxReturn(ajax)== true){
			Materialize.toast(ajax.responseText, 3000 );
		}
	}
	ajax.send("user_id="+id_user+"&id_car="+id_car+"&message="+message);

	}
}

// Change The Password.
function passChange(id){
	var id_user=id;
	var current=_("current_password").value;
	var newpass=_("change_password").value;
	var newconfirm=_("confirm_password").value;
	if(current=="" || newpass=="" || newconfirm==""){
		Materialize.toast("You did not fill in all the fields!", 3000 );

	}
	if(newpass != newconfirm){
		Materialize.toast("New password and confirm password fields have to match!", 3000 );
	}
	var aja=ajaxObj("POST","php_includes/getUserData.php");
	aja.onreadystatechange=function(){
		if(ajaxReturn(aja)== true){

			Materialize.toast("Password successefully changed!", 3000 );
		}
	}
		aja.send("current="+current+"&newpass="+newpass+"&newconfirm="+newconfirm+"&id_user="+id_user);
	}
//Sends the Contact Form
	function sendform(){
		var firstname=_("contact_firstname").value;
		var lastname=_("contact_lastname").value;
		var email=_("contact_email").value;
		var message=_("contact_message").value;
		if(firstname== "" || lastname== "" || email == "" || message== ""){
			Materialize.toast("Please fill in all the fields!", 3000 );
		}
		var ajax=ajaxObj("POST","php_includes/getUserData.php");
	    ajax.onreadystatechange=function(){
		if(ajaxReturn(ajax)== true){
			console.log(ajax.responseText);
			Materialize.toast(ajax.responseText, 3000 );
		}
	}
		ajax.send("mess="+message+"&firstname="+firstname+"&lastname="+lastname+"&email="+email);
	}
