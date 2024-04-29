<?php

  // Fonction pour charger les réservations depuis le fichier texte
function chargerReservations() {
    $reservations = [];
    $file = fopen("reservations.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode(",", $line);
            $reservation = [
                'id' => $data[0],
                'nom' => $data[1],
                'taille' => $data[2],
                'duree' => $data[3]
            ];
            $reservations[] = $reservation;
        }
        fclose($file);
    }
    return $reservations;
}

// Fonction pour sauvegarder les réservations dans le fichier texte
function sauvegarderReservations($reservations) {
    $file = fopen("reservations.txt", "a");
    if ($file) {
        foreach ($reservations as $reservation) {
            fwrite($file, implode(",", $reservation) . "\n");
        }
        fclose($file);
    }
}

// Fonction pour générer un identifiant unique pour une nouvelle réservation
function genererIdUnique($reservations) {
    $ids = array_column($reservations, 'id');
    if (empty($ids)) {
        return 1; // If $ids is empty, return 1 as the first ID
    } else {
        return max($ids) + 1; // Otherwise, return the maximum ID plus 1
    }
}


// Fonction pour ajouter une réservation
function ajouterReservation($nom, $taille, $duree) {
    $reservations = chargerReservations();
    $id = genererIdUnique($reservations);
    $reservation = ['id' => $id, 'nom' => $nom, 'taille' => $taille, 'duree' => $duree];
    $reservations[] = $reservation;
    sauvegarderReservations($reservations);
    // Redirect to reservations.php
    header("Location: http://localhost/?page=reservations");
    exit(); // Make sure nothing else is executed after redirection

}

// Fonction pour supprimer une réservation
function supprimerReservation($id) {
    $reservations = chargerReservations();
    foreach ($reservations as $key => $reservation) {
        if ($reservation['id'] == $id) {
            unset($reservations[$key]);
            break;
        }
    }
    sauvegarderReservations($reservations);
}

// Fonction pour afficher les réservations
function afficherReservations() {
    $reservations = chargerReservations();
    foreach ($reservations as $reservation) {
        echo "<div class='reservation'>";
        echo "<p>Nom du client: " . $reservation['nom'] . "</p>";
        echo "<p>Taille de la chambre: " . $reservation['taille'] . "</p>";
        echo "<p>Durée du séjour: " . $reservation['duree'] . "</p>";
        echo "<a href='?page=modifprod&id=" . $reservation['id'] . "'>Modifier</a> ";
        echo "<a href='?page=supprimer&id=" . $reservation['id'] . "'>Supprimer</a>";
        echo "</div>";
    }
}
    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérification des champs
        if (isset($_POST['nom']) && isset($_POST['taille']) && isset($_POST['duree'])) {
            // Validation des données
            $nom = $_POST['nom'];
            $taille = isset($_POST['taille']) ? $_POST['taille'] : '';
            $duree = isset($_POST['duree']) ? $_POST['duree'] : '';
            
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                // Now you can use $id safely
            } else {
                // Ajout
                ajouterReservation($nom, $taille, $duree);
            }
            

            // Traitement pour ajouter ou modifier la réservation
            // À compléter en fonction de votre logique d'application
            // Par exemple, appeler la fonction pour ajouter ou modifier une réservation
        } else {
            echo "<p class='w3-text-red'>Veuillez remplir tous les champs du formulaire.</p>";
        }
    }
    ?>
<div class="w3-container w3-blue-gray w3-card w3-margin-top" id="contact">
    <h2>Ajouter une reservation</h2>
    <form method="post" action="?page=modifresa">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
    <label class="w3-text-blue"><b>Nom du client</b></label>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" name="nom" required></p>
      <label class="w3-text-blue"><b>Prénom du client</b></label>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" name="prenom" required></p>
      <label class="w3-text-blue"><b>Taille de la chambre</b></label>
      <p><input class="w3-input w3-padding-16 w3-border"  type="number" name="taille" min="1" max="4" required></p>
      <label class="w3-text-blue"><b>Durée du séjour (en jours)</b></label>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="duree" min="1" max="15" required></p>
      <p><button class="w3-button w3-black w3-padding-large" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>