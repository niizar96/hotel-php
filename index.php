<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.w3-display-topleft {
    position: absolute;
    left: 99px;
    top: -9px;
}

.w3-row-padding{
    display: flex;
    gap: 20px;
}
</style>
</head>
<body class="w3-light-grey">

<!-- Navigation Bar -->





<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px; position:relative">
<nav class=" w3-bar-block w3-small w3-hide-small w3-center" style="position:absolute;left:0;top:0;height:100%;display:flex;flex-direction:column">
  <!-- Avatar image in top left corner -->
  <!-- <img src="/w3images/avatar_smoke.jpg" style="width:100%"> -->
  <a href="?page=init" class="w3-bar-item w3-button w3-padding-large w3-black  w3-opacity">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>Accueil</p>
  </a>
  <a href="?page=reservations" class="w3-bar-item w3-button w3-padding-large w3-black  w3-opacity">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>Réservations</p>
  </a>
  <a href="?page=modifresa" class="w3-bar-item w3-button w3-padding-large w3-black  w3-opacity">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>Ajouter une réservation</p>
  </a>
  <div style="width:100%; flex:1" class="w3-black  w3-opacity"></div>
</nav>
<div>
<img class="w3-image" src="./img/hotel_bg.jpg" alt="The Hotel" style="min-width:1000px" width="1500" height="800">
  <!-- <div class="w3-display-left w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-bed w3-margin-right"></i>Hotel Name</h2>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form action="/action_page.php" target="_blank">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-calendar-o"></i> Check In</label>
            <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY" name="CheckIn" required>
          </div>
          <div class="w3-half">
            <label><i class="fa fa-calendar-o"></i> Check Out</label>
            <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY" name="CheckOut" required>
          </div>
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-male"></i> Adults</label>
            <input class="w3-input w3-border" type="number" value="1" name="Adults" min="1" max="6">
          </div>
          <div class="w3-half">
            <label><i class="fa fa-child"></i> Kids</label>
          <input class="w3-input w3-border" type="number" value="0" name="Kids" min="0" max="6">
          </div>
        </div>
        <button class="w3-button w3-dark-grey" type="submit"><i class="fa fa-search w3-margin-right"></i> Search availability</button>
      </form>
    </div>
  </div> -->
  <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">Paris Monte-Carlo</h1>
      <h1 class="w3-hide-large w3-hide-medium">Paris Monte-Carlo</h1>
      <p><a href="#jeans" class="w3-button w3-black w3-padding-large w3-large w3-opacity">RESERVER</a></p>
    </div>
</div>
  
</header>

<!-- Page content -->
<div class="w3-container w3-padding-large " style="max-width:1532px; padding: 0;2rem; ">


<?php
    // Inclusion des fichiers selon la requête $_GET['page']
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page === 'init') {
            include 'init.php';
        } elseif ($page === 'reservations') {
            include 'reservations.php';
        } elseif ($page === 'modifresa') {
            include 'modifresa.php';
        } else {
            include 'init.php'; // Page par défaut si $_GET['page'] n'est pas valide
        }
    } else {
        include 'init.php'; // Page par défaut si $_GET['page'] n'est pas défini
    }
    ?>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-padding-32 w3-black w3-center w3-margin-top">
  <h5>Find Us On</h5>
  <div class="w3-xlarge w3-padding-16">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>

<!-- Add Google Maps -->
<script>
function myMap() {
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
