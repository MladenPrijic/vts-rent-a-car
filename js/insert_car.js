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

//CHecks if input is valid and sends variables to php file register.php
function insert_car(){
	var brand=_("brand").value;
	var model=_("model").value;
	var image=_("image").value;
	var year=_("year").value;
	var price_flat=_("price_flat").value;
	var price_day=_("price_day").value;
	var location=_("location").value;
	var seats=_("seats").value;
	var doors=_("doors").value;
	var automatic=_("automatic").value;
	var air_contitioning=_("air_contitioning").value;
	var luggage=_("luggage").value;
	var navigation=_("navigation").value;
	var description=_("description").value;
	var error=_("error");

	if(brand=="" || model== "" || image=="" || year=="" || price_flat=="" || price_day=="" || location=="" || seats=="" || doors=="" || automatic==""
	 || air_contitioning=="" || luggage=="" || navigation=="" || description=="" ){

		Materialize.toast('Please fill in the fields!', 4000);
	}
	else{

		var ajax=ajaxObj("POST","admin_insert.php");

		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax)== true){
				error.innerHTML=ajax.responseText;
			}
		}
		ajax.send("b="+brand+"&m="+model+"&i="+image+"&y="+year+"&pf="+price_flat+"&pd="+price_day+"&l="+location+"&s="+seats
			+"&d="+doors+"&a="+automatic+"&ac="+air_contitioning+"&lu="+luggage+"&n="+navigation+"&de="+description+);


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

		var ajax=ajaxObj("POST","main_update.php");

		ajax.onreadystatechange=function(){
			if(ajaxReturn(ajax)== true){
				error.innerHTML=ajax.responseText;
			}
		}
		ajax.send("u="+username+"&fn="+fName+"&ln="+lName+"&p="+password+"&cp="+confirm_password+"&e="+email+"&phone="+phone
			+"&s="+street+"&c="+city+"&z="+zip+"&co="+country);


	}
}
