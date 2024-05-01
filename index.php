<!DOCTYPE html>
<html>
<head>
    <title>Paris Monte-Carlo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Raleway", Arial, Helvetica, sans-serif
        }

        .w3-display-topleft {
            position: absolute;
            left: 160px;
            top: -9px;
        }
        header {
            width: 100%; position:relative;
            box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.9); /* Add box shadow */
        }
    </style>
</head>
<body class="w3-light-grey" style="min-height: 100vh;
    min-height: 100vh;
    display: flex;
    flex-direction: column;">

<!-- Navigation Bar -->


<!-- Header -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center w3-black w3-opacity" style="width: 150px; padding-top: 40px;">
    <!-- Avatar image in top left corner -->
    <a href="?page=init" class="w3-bar-item w3-button w3-padding-large  ">
        <i class="fa fa-home w3-xxlarge"></i>
        <p>Accueil</p>
    </a>
    <a href="?page=reservations" class="w3-bar-item w3-button w3-padding-large  ">
        <i class="fa fa-user w3-xxlarge"></i>
        <p>Réservations</p>
    </a>
    <a href="?page=modifresa" class="w3-bar-item w3-button w3-padding-large  ">
        <i class="fa fa-plus-circle w3-xxlarge"></i>
        <p>Ajouter une réservation</p>
    </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
    <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
        <a href="?page=init" class="w3-bar-item w3-button" style="width:33% !important">Accueil</a>
        <a href="?page=reservations" class="w3-bar-item w3-button" style="width:33% !important">Réservations</a>
        <a href="?page=modifresa" class="w3-bar-item w3-button" style="width:33% !important">Ajouter une réservation</a>
    </div>
</div>

<header class="w3-display-container">
    <div>
        <img class="w3-image" src="./img/hotel_bg.jpg" alt="The Hotel" style="width: 100%;height: 40vh
; object-fit: cover;">
        <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
            <h1 class="w3-jumbo w3-hide-small">Paris Monte-Carlo</h1>
            <h1 class="w3-hide-large w3-hide-medium">Paris Monte-Carlo</h1>
            <p><a href="?page=modifresa" class="w3-button w3-black w3-padding-large w3-large w3-opacity">RESERVER</a></p>
        </div>
    </div>

</header>

<!-- Page content -->
<div style="max-width:1532px; padding: 0;2rem; margin: auto ">


    <?php
    // Inclusion des fichiers selon la requête $_GET['page']
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page === 'init') {
            include 'init.php';
        } elseif ($page === 'reservations') {
            include 'reservations.php';
        } elseif ($page === 'modifresa' || $page === 'supprimer') {
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
    <h5><b>Paris Monte-Carlo</b></h5>
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
</body>
</html>
