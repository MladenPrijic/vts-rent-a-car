// Material Design OnLoad stuff
function ajaxmaterialize() {
  (function($){
    $(function(){

      $('.button-collapse').sideNav();

    }); // end of document ready
  })(jQuery); // end of jQuery name space

  Materialize.showStaggeredList("#staggered-test");
  $(document).ready(function(){
  $('.tooltipped').tooltip({delay: 50});
  });
  document.getElementById("footer").style.display = "block";
  $(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
  $(document).ready(function() {
    $('select').material_select();
  });
}

function profileAjax() {
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

}
