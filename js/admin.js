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
//shows all,rented and free cars
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
              jason[j]['firstname']="/";
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
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='First Name'>perm_identity</i><a class='secondary-content'>"+ jason[j]['firstname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Last Name'>perm_identity</i><a class='secondary-content'>"+ jason[j]['lastname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup Date'>today</i><a class='secondary-content'>"+ jason[j]['datetaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup City'>location_on</i><a class='secondary-content'>"+ jason[j]['citytaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Return Date'>today</i><a class='secondary-content'>"+ jason[j]['datereturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Return City'>location_off</i><a class='secondary-content'>"+ jason[j]['cityreturn']+"</a></div></li>"+
          "</ul>"+
          "<button style='margin-right: 10px; margin-bottom: 5px' class='red darken-2 btn waves-effect waves-light' onclick=\"del( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Delete"+
           "<i class='material-icons left'>warning</i></button>"+
           "<button style='margin-right: 5px; margin-bottom: 5px'  class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"free( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Free"+
           "<i class='material-icons left'>done</i></button>"+
           "<button style='margin-right: 40px; margin-bottom: 5px' class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"ren( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Reserve"+
           "<i class='material-icons left'>lock</i></button>"+
           "<button style='padding-left: 10px; padding-right: 0px; margin-bottom: 5px' class='deep-orange lighten-1 btn waves-effect waves-light modal-trigger' href='#car_comments' onclick=\"showMessages( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >"+
           "<i class='material-icons left'>chat_bubble_outline</i></button>"+
         "</div>"+
       "</div>"+

    "</li>";
}


    }

  ajaxmaterialize(); //loads the scrips needed for materialize to run correctly; trying to force the DRY programming rule; located inside init.js

  }
  ajax.send("cars="+cars);



}
//Loads all users and cars
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
              jason[j]['firstname']="/";
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
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='First Name'>perm_identity</i><a class='secondary-content'>"+ jason[j]['firstname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Last Name'>perm_identity</i><a class='secondary-content'>"+ jason[j]['lastname']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup Date'>today</i><a class='secondary-content'>"+ jason[j]['datetaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup City'>location_on</i><a class='secondary-content'>"+ jason[j]['citytaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Return Date'>today</i><a class='secondary-content'>"+ jason[j]['datereturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Return City'>location_off</i><a class='secondary-content'>"+ jason[j]['cityreturn']+"</a></div></li>"+
          "</ul>"+
           "<button style='margin-right: 10px; margin-bottom: 5px' class='red darken-2 btn waves-effect waves-light' onclick=\"del( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Delete"+
            "<i class='material-icons left'>warning</i></button>"+
            "<button style='margin-right: 5px; margin-bottom: 5px'  class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"free( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Free"+
            "<i class='material-icons left'>done</i></button>"+
            "<button style='margin-right: 40px; margin-bottom: 5px' class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"ren( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >Reserve"+
            "<i class='material-icons left'>lock</i></button>"+
            "<button style='padding-left: 10px; padding-right: 0px; margin-bottom: 5px' class='deep-orange lighten-1 btn waves-effect waves-light modal-trigger' href='#car_comments' onclick=\"showMessages( '"+ jason[j]['id_car']+"' )\" type='submit' name='action' id='"+jason[j]['id_car'] +" ' >"+
            "<i class='material-icons left'>chat_bubble_outline</i></button>"+
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
      //console.log( "Userssss"+ ajaxx.responseText);
      var jasonn=JSON.parse(ajaxx.responseText);
      //console.log(jasonn);
      var obj=typeof jasonn[0]["rented"];
      if(obj != 'undefined'){
        var o=jasonn[0]["rented"].length;
      //console.log(o);
      for(var r=0;r<o;r++){
      _("userDisplay").innerHTML+=
      "<a href=" +'#user_modal'+" class="+" 'collection-item modal-trigger' "+ "onclick=\"show('"+ jasonn[0]["rented"][r]['id_car']  +"','"+  jasonn[0]["rented"][r]["firstname"]+"')\" "   +">"+jasonn[0]["rented"][r]["firstname"]+"  "  +jasonn[0]["rented"][r]["lastname"] +"<span class="+'badge'+">Renting: "+jasonn[0]["rented"][r]["car_name"]+"</span></a>"
    }

    var e=jasonn[1]["free"].length;
    //console.log(e);
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
    for(var w=0;w<e;w++){
      _("userDisplay").innerHTML+=
      "<a href=" +'#user_modal'+" class="+" 'collection-item modal-trigger' "+  "onclick=\"showFree('"+ jasonn[1]["free"][w]['id_user']  +"','"+  jasonn[1]["free"][w]["firstname"]+"')\" "+">"+jasonn[1]["free"][w]["firstname"]+"  "  +jasonn[1]["free"][w]["lastname"] +"<span class="+'badge'+">Currently not renting</span></a>"

        }
      }
      else if(obj=='undefined'){
        var e=jasonn[0]["free"].length;
    $(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
    for(var w=0;w<e;w++){
      _("userDisplay").innerHTML+=
      "<a href=" +'#user_modal'+" class="+" 'collection-item modal-trigger' "+  "onclick=\"showFree('"+ jasonn[0]["free"][w]['id_user']  +"','"+  jasonn[0]["free"][w]["firstname"]+"')\" "+">"+jasonn[0]["free"][w]["firstname"]+"  "  +jasonn[0]["free"][w]["lastname"] +"<span class="+'badge'+">Currently not renting</span></a>"


      }


    }
    }
  }
  ajaxx.send("user");



}

//Function for deleting cars
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
//For making car free rented=0
function free(id,name){
   var id_car=id;
   var username=name;

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
//Shows user data in the modal
function show(id,name){
  _("userHistory").innerHTML="";
  var id_car=id;
  var firstname=name;
  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) == true){
              $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
      });
        //console.log("USERI"+ajax.responseText);
        var jason=JSON.parse(ajax.responseText);
        console.log(jason);
        var i=jason["rented"].length;
        _("profName").value=jason["userData"][0]["username"];
        _("firstname").value=jason["userData"][0]["firstname"];
         _("lastname").value=jason["userData"][0]["lastname"];
         _("usernamee").value=jason["userData"][0]["username"];
         _("firstnamee").value=jason["userData"][0]["firstname"];
         _("lastnamee").value=jason["userData"][0]["lastname"];
         _("usernam").value=jason["userData"][0]["username"];
         _("phonee").value=0+jason["userData"][0]["phone"];
         _("emaill").value=jason["userData"][0]["email"];
         _("addresss").value=jason["userData"][0]["street"];
         _("cityy").value=jason["userData"][0]["city"];
         _("zipp").value=jason["userData"][0]["zip"];
         _("countryy").value=jason["userData"][0]["country"];
         $(document).ready(function() {
             Materialize.updateTextFields();
             });


        _("currentRent").innerHTML=
         "<ul><li>"+
      "<div class='col s12 '>"+
       "<div class='card small hoverable'>"+
         "<div class='card-image waves-effect waves-block waves-light'>"+
         "<input type='hidden' id='"+"' value='"+jason["rented"][0]['id_car']+" '> "+
          " <img class='activator tooltipped' data-position='top' data-delay='50' data-tooltip='Click For More Info' src='img/cars/"+jason["rented"][0]["image"]+"'>"+
         "</div>"+
         "<div class='card-content'>"+
           "<span class='card-title activator grey-text text-darken-4'>"+ jason["rented"][0]['brand'] +' ' +jason["rented"][0]['model']+' | <span style="color: #29b6f6; weight: bold">$' +jason["rented"][0]['price_flat']+' rent + $' +jason["rented"][0]['price_day']+' per day'+"</span><i class='material-icons right'>more_vert</i></span>"+
         "</div>"+
         "<div class='card-reveal'>"+
          "<span class='card-title grey-text text-darken-4'>"+ jason["rented"][0]['brand'] +' ' +jason["rented"][0]['model']+' | <span style="color: #29b6f6; weight: bold">$' +jason["rented"][0]['price_flat']+' rent + $' +jason["rented"][0]['price_day']+' per day'+"</span><i class='material-icons right'>close</i></span>"+
          "<ul class='collection with-header'>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup City'>location_on</i><a class='secondary-content'>"+ jason["rented"][0]['citytaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup Time'>today</i><a class='secondary-content'>"+ jason["rented"][0]['datetaken']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Pickup City'>location_off</i><a class='secondary-content'>"+ jason["rented"][0]['cityreturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Return Date'>today</i><a class='secondary-content'>"+ jason["rented"][0]['datereturn']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Price Per Day'>credit_card</i><a class='secondary-content'>"+ jason["rented"][0]['price_day']+"</a></div></li>"+
           "<li class='collection-item'><div><i class='material-icons tooltipped' data-position='right' data-delay='50' data-tooltip='Year'>today</i><a class='secondary-content'>"+ jason["rented"][0]['year']+"</a></div></li>"+
          "</ul>"+
          "<button style='margin-right: 5px; margin-bottom: 5px'  class='deep-orange lighten-1 btn waves-effect waves-light' onclick=\"free( '"+ jason["rented"][0]['id_car']+"' )\" type='submit' name='action' id='"+jason["rented"][0]['id_car'] +" ' >Free"+
          "<i class='material-icons left'>done</i></button>"+

         "</div>"+
       "</div>"+
    "</div>"+
    "</li></ul>";
    $(document).ready(function(){
      $('.tooltipped').tooltip({delay: 50});
    });
    var l=jason["history"].length;
    for(var t=0;t<l;t++){

    _("userHistory").innerHTML+=
    "<li>"+
                    "<div class="+"collapsible-header"+"><i class="+"material-icons"+">info</i>"+jason["history"][t]['brand'] +" "+jason["history"][t]['model']  +"</div>"+
                    "<div class="+"collapsible-body"+">"+
                      "<p>"+
                        "Rented from: "+ jason["history"][t]["datetaken"]+ " to "+jason["history"][t]["datereturn"]
                      "</p>"+
                      "<p>"+
                        "Message They left if they left a message"+
                      "</p>"+
                    "</div>"+
                  "</li>"
                }


      }





  }
  ajax.send("id_carr="+id_car+"&userr="+firstname);
}

function showFree(id,name){
  _("userHistory").innerHTML="";
  var id_user=id;
  var firstname=name;
  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){

      if(ajaxReturn(ajax) == true){
              $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
      });
        //console.log(ajax.responseText);
        var jason=JSON.parse(ajax.responseText);
        console.log(jason);
        var obj=typeof jason["history"][0];
        if(obj !='undefined'){
        var i=jason["history"].length;
        console.log(jason["userData"][0]["firstname"]);

        _("profName").value=jason["userData"][0]["username"];
        _("firstname").value=jason["userData"][0]["firstname"];
         _("lastname").value=jason["userData"][0]["lastname"];
         _("usernamee").value=jason["userData"][0]["username"];
         _("firstnamee").value=jason["userData"][0]["firstname"];
         _("lastnamee").value=jason["userData"][0]["lastname"];
         _("usernam").value=jason["userData"][0]["username"];
         _("phonee").value=0+jason["userData"][0]["phone"];
         _("emaill").value=jason["userData"][0]["email"];
         _("addresss").value=jason["userData"][0]["street"];
         _("cityy").value=jason["userData"][0]["city"];
         _("zipp").value=jason["userData"][0]["zip"];
         _("countryy").value=jason["userData"][0]["country"];

             $(document).ready(function() {
             Materialize.updateTextFields();
             });

         _("currentRent").innerHTML=
         "<ul><li>"+
      "<p> This user is currently not renting! </p>"+
    "</li></ul>";
        for(var m=0;m<i;m++){


    _("userHistory").innerHTML+=
    "<li>"+
                    "<div class="+"collapsible-header"+"><i class="+"material-icons"+">info</i>"+jason["history"][m]['brand'] +" "+jason["history"][m]['model']  +"</div>"+
                    "<div class="+"collapsible-body"+">"+
                      "<p>"+
                        "Rented from: "+ jason["history"][m]["datetaken"]+ " to "+jason["history"][m]["datereturn"]+
                      "</p>"+
                      "<p>"+
                        "Message They left if they left a message"+
                      "</p>"+
                    "</div>"+
                  "</li>";
                }


      }
      else if(obj == 'undefined'){
        _("profName").value=jason["userData"][0]["username"];
        _("firstname").value=jason["userData"][0]["firstname"];
         _("lastname").value=jason["userData"][0]["lastname"];
         _("usernamee").value=jason["userData"][0]["username"];
         _("firstnamee").value=jason["userData"][0]["firstname"];
         _("lastnamee").value=jason["userData"][0]["lastname"];
         _("usernam").value=jason["userData"][0]["username"];
         _("phonee").value=0+jason["userData"][0]["phone"];
         _("emaill").value=jason["userData"][0]["email"];
         _("addresss").value=jason["userData"][0]["street"];
         _("cityy").value=jason["userData"][0]["city"];
         _("zipp").value=jason["userData"][0]["zip"];
         _("countryy").value=jason["userData"][0]["country"];

         $(document).ready(function() {
         Materialize.updateTextFields();
         });

         _("currentRent").innerHTML=
         "<ul><li>"+
      "<p> This user is currently not renting! </p>"+
    "</li></ul>";
    _("userHistory").innerHTML="<p>No rent history! <p>";

      }
    }





  }
  ajax.send("id_userr="+id_user+"&userr="+firstname);

}



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
//Makes car rented, rented=1
function ren(id){
  var id_car=id;
  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){
      if(ajaxReturn(ajax)== true){
        console.log(ajax.responseText);
        Materialize.toast(ajax.responseText,3000);
      }
    }
    ajax.send("id_car_rentt="+id_car);

}
//Shows the messages for every car
function showMessages(car_id){
  var car=car_id;
   _("userResponse").innerHTML="";
  var ajax=ajaxObj("POST","php_includes/admin_panel.php");
  ajax.onreadystatechange=function(){
      if(ajaxReturn(ajax)== true){

        var jason=JSON.parse(ajax.responseText);

        var i=jason.length;

        for(var j=0;j<i;j++){
        _("userResponse").innerHTML+=
        "<li>"+
    "<div class=collapsible-header><i class=material-icons>chat_bubble_outline</i>"+jason[j]['firstname'] +" "+jason[j]['lastname'] +" left a message on: "+ jason[j]['dateleft'] +" </div>"+
    "<div class=collapsible-body><p>"+jason[j]['message']+"</p></div>"+
  "</li>";

}

      }
    }
    ajax.send("showMessage="+car);

}
