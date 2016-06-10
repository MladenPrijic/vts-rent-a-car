function _(x){
	return document.getElementById(x);
}

function check_name(){
	var username=_("login_username").value;

	if(username.length < 4 || username.length > 16){
		_("error").innerHTML="Username has to be between 4 and 16 characters!";
	}


}
