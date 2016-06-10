//Ajax function, instead of writing all of ajax code, I just call the functions
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
//Limits what you can input on username and email field
function limit(elem){
	var tf=_(elem);
	var rx=new RegExp;

	if(elem=='email'){
		rx=/[' "]/gi;
	}
	else if(elem=='username')
		 {
		 	rx=/[^a-z0-9]/gi;
		 }
		 tf.value=tf.value.replace(rx,"");

}
//Checks username with the database
function check_username(){
	var username=_("username").value;

	if(username != ""){

		var ajax=ajaxObj("POST","register.php");
		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax) == true )
	 			{
	 				_("check_name").innerHTML=ajax.responseText;
	 			}
		}

	}
	ajax.send("us="+username);


}


//CHecks if input is valid and sends variables to php file register.php
function signup(){
	var username=_("username").value;
	var fName=_("fName").value;
	var lName=_("lName").value;
	var fName=_("fName").value;
	var password=_("password").value;
	var confirm_password=_("confirm_password").value;
	var email=_("email").value;
	var phone=_("phone").value;
	var street=_("street").value;
	var city=_("city").value;
	var zip=_("zip").value;
	var country=_("country").value;
	var error=_("error");

	if(username=="" || fName== "" || lName=="" || password=="" || confirm_password=="" || email=="" || phone==""
	 || street=="" || city=="" || zip=="" || country=="" ){

		Materialize.toast('Please fill in the fields!', 4000);

	}
	if(username !=="" && username.length < 4 || username.length > 16){
		Materialize.toast('Username has to be between 4 and 16 characters!', 4000);
	}
	if(password !=="" && password != confirm_password){
		Materialize.toast('Passwords have to match!', 4000);
	}
	else{

		var ajax=ajaxObj("POST","register.php");

		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax)== true){
				error.innerHTML=ajax.responseText;
			}
		}
		ajax.send("u="+username+"&fn="+fName+"&ln="+lName+"&p="+password+"&cp="+confirm_password+"&e="+email+"&phone="+phone
			+"&s="+street+"&c="+city+"&z="+zip+"&co="+country);


	}
}
function update(){
	var username=_("username").value;
	var fName=_("fName").value;
	var lName=_("lName").value;
	var fName=_("fName").value;
	var password=_("password").value;
	var confirm_password=_("confirm_password").value;
	var email=_("email").value;
	var phone=_("phone").value;
	var street=_("street").value;
	var city=_("city").value;
	var zip=_("zip").value;
	var country=_("country").value;
	var error=_("error");

	if(username=="" || fName== "" || lName=="" || password=="" || confirm_password=="" || email=="" || phone==""
	 || street=="" || city=="" || zip=="" || country=="" ){

		Materialize.toast('Please fill in the fields!', 4000);

	}
	if(username !=="" && username.length < 4 || username.length > 16){
		Materialize.toast('Username has to be between 4 and 16 characters!', 4000);
	}
	if(password !=="" && password != confirm_password){
		Materialize.toast('Passwords have to match!', 4000);
	}
	else{

		var ajax=ajaxObj("POST","update.php");

		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax)== true){
				error.innerHTML=ajax.responseText;
			}
		}
		ajax.send("u="+username+"&fn="+fName+"&ln="+lName+"&p="+password+"&cp="+confirm_password+"&e="+email+"&phone="+phone
			+"&s="+street+"&c="+city+"&z="+zip+"&co="+country);


	}
}
