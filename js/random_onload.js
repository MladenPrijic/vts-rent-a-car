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

//Shows the current car of the user and history, so he/she can make a comment
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
						$(document).ready(function(){
						$('.tooltipped').tooltip({delay: 50});
						});
						document.getElementById("footer").style.display = "block";
						//preloader.off();
						$(document).ready(function(){
							// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
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
//sends a message into the db
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
//sends the contact form
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
