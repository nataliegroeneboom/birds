<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $page_title? strip_tags($page_title): "Bird Encylopedia" ?></title>
    <!-- jquery theme roller -->
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

  <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="/libs/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/libs/css/owl.theme.default.min.css" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" type="text/css" href="/libs/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" />

</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/home">Bird Encyclopedia</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php echo $page_title==="Index"?"class='active'":"";?>>
                <a href="/home"><span class="glyphicon glyphicon-home"></span>Home</a>
          </li>
        </ul>
        <?php if($loggedIn):?>
        <ul class="nav navbar-nav navbar-right" style="margin-bottom:0;">
          <li <?=$page_title=="Edit Profile"?"class='active'":"";?> >
            <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              &nbsp;&nbsp;<?=$_SESSION['username']; ?>
              &nbsp;&nbsp;
               <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="/sighting/create">Add a sighting</a>
                <a href="/logout">Logout</a>
              </li>

            </ul>
          </li>
        </ul>
      <?php else:?>
        <ul class="nav navbar-nav navbar-right">
          <li <?=$page_title=="Login"? "class='active'": "";?>>
            <a href="/login">
              <span class="glyphicon glyphicon-log-in"></span> Login
            </a>
          </li>
          <li <?=$page_title=="Register"?"class='active'": "";?>>
            <a href="/user/register">
              <span class="glyphicon glyphicon-check"></span>Register
            </a>
          </li>
        </ul>

<?php
endif;?>
      </div><!--/.nav-collapse-->
    </div>
</div>

<!--/.navbar-->
<div class="hero">
<div class="darken-overlay">
  <h1>Explore the world of Australian Birds</h1>
</div>
</div>

<div class="container"><!-- container -->
<?php  if(isset($_GET['q']) && $_GET['q']!=='/home'):
  echo '<button id="btn-back"><span class="	glyphicon glyphicon-arrow-left"></span><a href="/home"> Back to Home page</a></button>';
endif;
?>
  <div class="page-header">
    <?php if($page_title!="Login"){ ?>
      <h1><?= isset($page_title) ? $page_title : "World of Australian Birds" ?></h1>
  </div>
  <?php } 
 if(isset($_SESSION['error'])){
   foreach($_SESSION['error'] as $error){
    echo $error;
   }
   unset($_SESSION['error']);
 }

  ?>
  
<main>


<?=$output?>
</main>
  </div>
  <footer><div class="container"> This website is purely for website development training purposes</div></footer>
 </body> 
<!-- /container -->

 
  <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script> 


<script src="/libs/js/owl.carousel.min.js"></script>


<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>




<!-- Clamp.js file library -->
<script src="/libs/js/clamp.min.js"></script>

<script src="/libs/js/main.js"></script>




<!-- google maps -->
<script>
function initialize(){
  if(getMarkers() !== 0){
      initMap();
  }
  if(getRoute() == 1){
      initAutocomplete()
  }
  // google.maps.event.addDomListener(window, 'resize', initMap);
  //    google.maps.event.addDomListener(window, 'load', initMap);
}


var autocomplete;
var bounds;

function initAutocomplete() {

  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  var options = {
  componentRestrictions: {country: "au"}
 };
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), options);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    console.log('fill int');
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  console.log(place);
  document.getElementById('place').value = place.name;
var lat = place.geometry.location.lat();
console.log(lat);
document.getElementById('lat').value = lat;
console.log(lat);

var lng = place.geometry.location.lng();
document.getElementById('lng').value = lng;

}

// function geolocate() {
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(function(position) {
//             var geolocation = {
//                 lat: position.coords.latitude,
//                 lng: position.coords.longitude
//             };
//             var circle = new google.maps.Circle(
//                 {center: geolocation, radius: position.coords.accuracy});
//             autocomplete.setBounds(circle.getBounds());
//         });
//     }
// }
function getMarkers(){
    var markers = <?php echo $coordinates == ''? 0 : $coordinates ?>;
     return markers;
 }

function getRoute(){
    var route = <?php echo $route == 'sighting/create'? 1 : 0 ?>;
    return route;
}

// map.fitBounds(new google.maps.LatLngBounds(new google.maps.LatLng(51.522, -0.136), new google.maps.LatLng(51.526, -0.12)))



function initMap() {
    var location = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById("map"),
        {
            zoom: 4,
            center: location
        });
       
        var markers = getMarkers();
        var infowindow = new google.maps.InfoWindow();
       

        for (var i = 0, length = markers.length; i < length; i++) {
        var data = markers[i];
        latLng = new google.maps.LatLng(data['latitude'], data['longitude']);
      
        // // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
        });
   
        
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                var content = '<h5>' + markers[i]['place'] + '</h5>' +
                    '<div><p>' + markers[i]['body'] + '</p></div>' +
                "<div><p class='user'>" + markers[i]['name'] + "</p>"

                infowindow.setContent(content);
                if(!marker.open){
                    infowindow.open(map, marker);
                    marker.open = true;
                }else{
                    infowindow.close();
                    marker.open = false;
                }
            }
        })(marker, i));
      } 
  
}







</script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlXmpU-qkL1g7zv0ysjFh4jrJY9HtB7sg&libraries=places&callback=initialize"
async defer></script>


</body>
</html>