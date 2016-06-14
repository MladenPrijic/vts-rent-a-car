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
            if(jason[j]['firstname'] == null){
              jason[j]['firstname']="No one";
            }
            if(jason[j]['lastname'] == null){
              jason[j]['lastname']="/";
            }
            if(jason[j]['citytaken'] == null){
              jason[j]['citytaken']="/";
            }
            if(jason[j]['cityreturn'] == null){
              jason[j]['cityreturn']="/";
            }
            if(jason[j]['datetaken'] == null){
              jason[j]['datetaken']="/";
            }
            if(jason[j]['datereturn'] == null){
              jason[j]['datereturn']="/";
            }
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
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason[j]['firstname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason[j]['lastname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason[j]['datetaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason[j]['citytaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>"+ jason[j]['datereturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason[j]['cityreturn']+"</a></div></li>"+
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
      //console.log(ajax.responseText);
      var jason=JSON.parse(ajax.responseText);
      //console.log(jason);
      var i=jason.length;
          //console.log(i);
          for(var j=0; j<i; j++){
            if(jason[j]['firstname'] == null){
              jason[j]['firstname']="No one";
            }
            if(jason[j]['lastname'] == null){
              jason[j]['lastname']="/";
            }
            if(jason[j]['citytaken'] == null){
              jason[j]['citytaken']="/";
            }
            if(jason[j]['cityreturn'] == null){
              jason[j]['cityreturn']="/";
            }
            if(jason[j]['datetaken'] == null){
              jason[j]['datetaken']="/";
            }
            if(jason[j]['datereturn'] == null){
              jason[j]['datereturn']="/";
            }
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
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Seats'>perm_identity</i><a class='secondary-content'>"+ jason[j]['firstname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Doors'>tab</i><a class='secondary-content'>"+ jason[j]['lastname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Air Conditioning'>invert_colors</i><a class='secondary-content'>"+ jason[j]['datetaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Transmission'>settings</i><a class='secondary-content'>"+ jason[j]['citytaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Navigation'>navigation</i><a class='secondary-content'>"+ jason[j]['datereturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Luggage'>work</i><a class='secondary-content'>"+ jason[j]['cityreturn']+"</a></div></li>"+
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
  ajax.send("some");

  //Loads users into users tab

  var ajaxx=ajaxObj("POST","php_includes/admin_panel.php");
  ajaxx.onreadystatechange=function(){
    if(ajaxReturn(ajaxx)== true){
      $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
      console.log( "Userssss"+ ajaxx.responseText);
      var jasonn=JSON.parse(ajaxx.responseText);
      console.log(jasonn);
      var o=jasonn[0]["rented"].length;
      //console.log(o);
      for(var r=0;r<o;r++){
      _("userDisplay").innerHTML+=
      "<a href=" +'#user_modal'+" class="+" 'collection-item modal-trigger' "+ "onclick=\"show('"+ jasonn[0]["rented"][r]['id_car']+"')\" "   +">"+jasonn[0]["rented"][r]["firstname"]+"  "  +jasonn[0]["rented"][r]["lastname"] +"<span class="+'badge'+">Renting: "+jasonn[0]["rented"][r]["car_name"]+"</span></a>"
    }
    var e=jasonn[1]["free"].length;
    //console.log(e);
    for(var w=0;w<e;w++){
      _("userDisplay").innerHTML+=
      "<a href=" +'#'+" class="+" 'collection-item modal-trigger' "+">"+jasonn[1]["free"][w]["firstname"]+"  "  +jasonn[1]["free"][w]["lastname"] +"<span class="+'badge'+">Currently not renting</span></a>"
 

    }
    }
  }
  ajaxx.send("user");



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

// function show(id){
//   _("user_modal").style.zIndex=1003;
//   _("user_modal").style.display="block";
//   _("user_modal").style.opacity=1;
//   _("user_modal").style.transform="scaleX(1)";
//   _("user_modal").style.top="10%";



// }

// style="z-index: 1003; display: block; opacity: 1; transform: scaleX(1); top: 10%;"

function insertCar(){
  var brand=_("brand").value;
  var model=_("model").value;
  var image=_("image").value;
  var year=_("Year").value;
  var price_flat=_("pricef").value;
  var price_day=_("priced").value;
  var location=_("location").value;
  var seats=_("seats").value;
  var doors=_("doors").value;
  var automatic=_("automatic").value;
  var air_conditioning=_("ac").value;
  var luggage=_("luggage").value;
  var navigation=_("navigation").value;
  var description=_("description").value;
  var error=_("error");
  console.log(seats);

  if(brand=="" || model== "" || image=="" || year=="" || price_flat=="" || price_day=="" || location=="" || seats=="" || doors=="" || automatic==""
   || air_conditioning=="" || luggage=="" || navigation=="" || description=="" ){

    Materialize.toast('Please fill in the fields!', 4000);
  }
  else{

    var aja=ajaxObj("POST","php_includes/admin_panel.php");

    aja.onreadystatechange=function(){
      if(ajaxReturn(aja)== true){
        //console.log(aja.returnText);
        Materialize.toast(aja.responseText,3000);
      }
    }
    aja.send("b="+brand+"&m="+model+"&i="+image+"&y="+year+"&pf="+price_flat+"&pd="+price_day+"&l="+location+"&s="+seats
      +"&d="+doors+"&a="+automatic+"&ac="+air_conditioning+"&lu="+luggage+"&n="+navigation+"&de="+description);


  }
}
