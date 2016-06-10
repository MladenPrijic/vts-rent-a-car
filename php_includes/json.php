<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<button onclick="getData()"> Get data</button>
<ul class="staggered-list" id="staggered-test">
    
  </ul>
<script type="text/javascript">
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

function getData(){
	var ajax=ajaxObj("get","getJson.php");
	ajax.onreadystatechange=function(){
		if(ajaxReturn(ajax)== true){
			var jason=JSON.parse(ajax.responseText);
			console.log(jason);
			var i=jason.length;
	        //console.log(i);
	        for(var j=0; j<i; j++){
	        	_("staggered-test").innerHTML+=
	        	"<li>"+
	        		"<div class='col s12 m6'>"+
       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/''>"+
         "</div>"+
         "<div class='card-content'>"+
           "<span class='card-title activator grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+"<i class='material-icons right'><!--more_vert --></i></span>"+
           "<p>"+ jason[j]['description']+"</p>"+
         "</div>"+
         "<div class='card-reveal'>"+
          "<span class='card-title grey-text text-darken-4'>"+ jason[j]['brand'] +' ' +jason[j]['model']+"<i class='material-icons right'>close</i></span>"+
          "<ul class='collection with-header'>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason[j]['seats']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason[j]['doors']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason[j]['air_conditioning']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason[j]['automatic']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>Yes</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason[j]['luggage']+"</a></div></li>"+
          "</ul>"+
           "<button class='btn waves-effect waves-light' onclick='info()' type='submit' name='action'>Choose"+
            "<i class='material-icons left'>done</i></button>"+
         "</div>"+
       "</div>"+
    "</div>"+
    "</li>"


	        		;
	        }

	        
		}
	}
	ajax.send("req="+1);

	
}


</script>

</body>
</html>