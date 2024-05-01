<?php

// Fonction pour charger les réservations depuis le fichier texte
function chargerReservations()
{
    $reservations = [];
    $file = fopen("reservations.txt", "r");

    if ($file) {
        while (($line = fgets($file)) !== false) {
            // Supprimer les espaces vides au début et à la fin de la ligne
            $line = trim($line);

            if (!empty($line)) {
                $data = explode(",", $line);
                if (count($data) >= 5) {
                    $reservation = [
                        'id' => $data[0],
                        'nom' => $data[1],
                        'prenom' => $data[2],
                        'taille' => $data[3],
                        'duree' => $data[4]
                    ];
                    $reservations[] = $reservation;
                }
            }
        }
        fclose($file);
    }

    return $reservations;
}

// Fonction pour sauvegarder les réservations dans le fichier texte
function sauvegarderReservations($reservations)
{
    $file = fopen("reservations.txt", "w");
    if ($file) {
        foreach ($reservations as $reservation) {
            fwrite($file, implode(",", $reservation) . "\n");
        }
        fclose($file);
    }
}

// Fonction pour générer un identifiant unique pour une nouvelle réservation
function genererIdUnique($reservations)
{
    $ids = array_column($reservations, 'id');
    if (empty($ids)) {
        return 1; // If $ids is empty, return 1 as the first ID
    } else {
        return max($ids) + 1; // Otherwise, return the maximum ID plus 1
    }
}


// Fonction pour ajouter une réservation
function ajouterReservation($nom, $prenom, $taille, $duree)
{
    $reservations = chargerReservations();
    $id = genererIdUnique($reservations);
    $reservation = ['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'taille' => $taille, 'duree' => $duree];
    $reservations[] = $reservation;
    sauvegarderReservations($reservations);
    // Redirect to reservations.php
}

// Fonction pour récupérer les données d'une réservation par son identifiant
function recupererReservationParId($id)
{
    $reservations = chargerReservations();
    foreach ($reservations as $reservation) {
        if ($reservation['id'] == $id) {
            return $reservation;
        }
    }
    return null; // Retourne null si aucune réservation n'est trouvée avec cet identifiant
}


// Fonction pour mettre à jour une réservation
function mettreAJourReservation($id, $nom, $prenom, $taille, $duree)
{
    $reservations = chargerReservations();

    foreach ($reservations as &$reservation) {
        if ($reservation['id'] == $id) {
            $reservation['nom'] = $nom;
            $reservation['prenom'] = $prenom;
            $reservation['taille'] = $taille;
            $reservation['duree'] = $duree;
            break;
        }
    }
    unset($reservation); // Unset the reference to prevent accidental modification
    sauvegarderReservations($reservations);
}

$reservationToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $reservationToEdit = recupererReservationParId($id);
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des champs
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['taille']) && isset($_POST['duree'])) {
        // Validation des données
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $taille = $_POST['taille'];
        $duree = $_POST['duree'];
        if (!empty($_POST['id'])) {
            // Modification de la réservation existante
            $id = $_POST['id'];
            mettreAJourReservation($id, $nom, $prenom, $taille, $duree);
            $message = "La réservation a été modifiée avec succès.";

        } else {
            // Ajout
            ajouterReservation($nom, $prenom, $taille, $duree);
            $message = "La réservation a été ajoutée avec succès.";

        }


        // Traitement pour ajouter ou modifier la réservation
        // À compléter en fonction de votre logique d'application
        // Par exemple, appeler la fonction pour ajouter ou modifier une réservation
    } else {
        $message = "Veuillez remplir tous les champs du formulaire.";
    }
}
?>
<div style="width: 100%; display: flex; justify-content: center; margin: 4rem 0; gap: 2rem;">
    <?php if (!empty($message)) : ?>
        <!-- Affichage du message après traitement -->
        <div style="display: flex; justify-content: center; width: 100%">
            <div class="w3-panel w3-pale-green w3-leftbar">
                <p><b><?php echo $message; ?></b></p>
                <p><a href="?page=reservations">Retourner à la liste des réservations</a></p>
            </div>
        </div>

    <?php else : ?>
    <div class="w3-container w3-card w3-margin-top w3-leftbar" style="width: 70vw;" id="contact">

            <!-- Affichage du formulaire d'ajout ou de modification -->
            <h2><?php echo isset($_GET['id']) ? 'Modifier la réservation' : 'Ajouter une réservation'; ?></h2>
            <form method="post" action="?page=modifresa">
                <?php if (isset($_GET['id'])) : ?>
                    <!-- For editing existing reservation -->
                    <label><b>ID de réservation</b></label>
                    <p><input class="w3-input w3-padding-16 w3-border" type="text" name="id" value="<?php echo isset($reservationToEdit['id']) ? htmlspecialchars($reservationToEdit['id']) : ''; ?>" readonly></p>
                <?php else : ?>
                    <!-- For adding new reservation (hidden ID field) -->
                    <input type="hidden" name="id" value="">
                <?php endif; ?>                <label><b>Nom du client</b></label>
                <p><input class="w3-input w3-padding-16 w3-border" type="text" name="nom" value="<?php echo htmlspecialchars($reservationToEdit['nom']); ?>" required></p>
                <label><b>Prénom du client</b></label>
                <p><input class="w3-input w3-padding-16 w3-border" type="text" name="prenom" value="<?php echo htmlspecialchars($reservationToEdit['prenom']); ?>" required></p>
                <label><b>Taille de la chambre</b></label>
                <p><input class="w3-input w3-padding-16 w3-border" type="number" name="taille" value="<?php echo htmlspecialchars($reservationToEdit['taille']); ?>" min="12"  required></p>
                <label><b>Durée du séjour (en jours)</b></label>
                <p><input class="w3-input w3-padding-16 w3-border" type="number" name="duree" value="<?php echo htmlspecialchars($reservationToEdit['duree']); ?>" min="1" max="15" required></p>
                <p>
                    <button class="w3-button w3-black w3-padding-large w3-opacity" type="submit">
                        <?php echo isset($_GET['id']) ? 'Modifier' : 'Ajouter'; ?>
                    </button>
                </p>
            </form>
        <?php endif; ?>
    </div>
</div>
