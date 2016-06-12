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

function adminShow(){
	var cars=_("cars").value;

	_("staggered-test").innerHTML="";
	var ajax=ajaxObj("POST","php_includes/admin_panel.php");
	ajax.onreadystatechange=function(){

			if(ajaxReturn(ajax) === true){
			console.log(ajax.responseText);
			var jason=JSON.parse(ajax.responseText);
			console.log(jason);
			var i=jason.length;
	        console.log(i);
	        for(var j=0; j<i; j++){
	        	_("staggered-test").innerHTML+=
	        		"<li>"+

       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
         "<input type='hidden' id='"+j+"' value='"+jason[j]['id_car']+" '> "+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason[j]["image"]+"'>"+
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
           "<button class='btn waves-effect waves-light' onclick=\"del( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Delete"+
            "<i class='material-icons left'>done</i></button>"+
            "<button class='btn waves-effect waves-light' onclick=\"free( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Free"+
            "<i class='material-icons left'>done</i></button>"+
         "</div>"+
       "</div>"+

    "</li>";
}


		}

  ajaxmaterialize(); //loads the scrips needed for materialize to run correctly; trying to force the DRY programming rule; located inside init.js

	}
	ajax.send("cars="+cars);



}

function adminLoadAll(){

  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) === true){
      console.log(ajax.responseText);
      var jason=JSON.parse(ajax.responseText);
      console.log(jason);
      var i=jason.length;
          console.log(i);
          for(var j=0; j<i; j++){
            _("staggered-test").innerHTML+=
              "<li>"+

       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
         "<input type='hidden' id='"+j+"' value='"+jason[j]['id_car']+" '> "+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason[j]["image"]+"'>"+
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
           "<button style='margin-right: 5px' class='btn waves-effect waves-light' onclick=\"del( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Delete"+
            "<i class='material-icons left'>done</i></button>"+
            "<button class='btn waves-effect waves-light' onclick=\"free( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Free"+
            "<i class='material-icons left'>done</i></button>"+
         "</div>"+
       "</div>"+

    "</li>";
}


    }

  ajaxmaterialize(); //loads the scrips needed for materialize to run correctly; trying to force the DRY programming rule; located inside init.js

  }
  ajax.send("some");


}


function del(id){
  var id_car=id;

  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) === true){
        var ret=ajax.responseText;
        console.log(ret);
        Materialize.toast(ret, 3000 );

      }


}
ajax.send("id_car_del="+id_car);
}

function free(id){
   var id_car=id;

  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) === true){
        var ret=ajax.responseText;
        console.log(ret);
        Materialize.toast(ret, 3000 );


      }


}
ajax.send("id_car_free="+id_car);

}

function userShow(){


  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) === true){
      console.log(ajax.responseText);
      var jason=JSON.parse(ajax.responseText);
      console.log(jason);
      var i=jason.length;
      console.log(i);
      var j=jason[0]['all'].length;
      console.log("Length of all users: "+j);



      for(var k=0; k<j; k++){
        _("all_users").innerHTML+=
        "<option value='"+ jason[0]['all'][k]['firstname']+"' >"+ jason[0]['all'][k]['firstname']+"</option>";
        console.log(jason[0]['all'][k]['firstname']);


      }

      var c=jason[1]['rented'].length;
      console.log("Length of rented users: "+c);



      for(var k=0; k<c; k++){
        _("renting_users").innerHTML+=
        "<option value='"+ jason[1]['rented'][k]['firstname']+"' >"+ jason[1]['rented'][k]['firstname']+"</option>";
        console.log(jason[1]['rented'][k]['firstname']);


      }

      var p=jason[2]['free'].length;
      console.log("Length of free users: "+p);



      for(var k=0; k<p; k++){
        _("free_users").innerHTML+=
        "<option value='"+ jason[2]['free'][k]['firstname']+"' >"+ jason[2]['free'][k]['firstname']+"</option>";
        console.log(jason[2]['free'][k]['firstname']);


      }

   }
   ajaxmaterialize();
  }
  ajax.send("user");
}
