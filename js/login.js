function _(x){
	return document.getElementById(x);
}

function check_name(){
	


}
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

function login(){
	var username=_("login_username").value;
	var password=_("login_password").value;
	if(username=="" || password==""){
		Materialize.toast("please insert all the data!", 3000 );
	}
	var ajax=ajaxObj("POST","php_includes/login.php");
    ajax.onreadystatechange=function(){
      if(ajaxReturn(ajax)==true){
      	var ret=ajax.responseText;
      	console.log(ret);
      	if(ret == 1){
      		window.location="main.php";

      	}
      	else if(ret ==2){
      		Materialize.toast("Wrong username or password!", 3000 );
      	}

        

    }
}
ajax.send("username="+username+"&password="+password)

}
