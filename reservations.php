<?php
// Function to load reservations from the text file
function loadReservations()
{
    $reservations = [];
    $file = fopen("reservations.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode(",", $line);
            $reservation = [
                'id' => $data[0],
                'nom' => $data[1],
                'prenom' => $data[2],
                'taille' => $data[3],
                'duree' => $data[4]
            ];
            $reservations[] = $reservation;
        }
        fclose($file);
    }
    return $reservations;
}

function saveReservations($reservations)
{
    $file = fopen("reservations.txt", "w"); // Open file for writing (truncate existing content)
    if ($file) {
        foreach ($reservations as $reservation) {
            // Prepare the data to be written to the file, ensuring no extra whitespace
            $line = implode(",", $reservation);
            $line = trim($line); // Trim any leading/trailing whitespace

            fwrite($file, $line . "\n"); // Write the line to the file
        }
        fclose($file); // Close the file handle
    }
}


// Process reservation deletion when ID is provided in the URL
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    $reservations = loadReservations();

    // Find and remove the reservation with the specified ID
    foreach ($reservations as $key => $reservation) {
        if ($reservation['id'] == $deleteId) {
            unset($reservations[$key]);
            break;
        }
    }

    // Save the updated reservations list back to the file
    saveReservations($reservations);

    // Redirect back to the reservations page to reflect changes
    header("Location: ?page=reservations");
    exit();
}

// Load reservations data
$reservations = loadReservations();
?>
<?php if (empty($reservations)) : ?>
    <!-- Affichage du message après traitement -->
    <div style="display: flex; justify-content: center; width: 100%">
        <div class="w3-panel w3-pale-yellow w3-leftbar">
            <p><b>Aucune réservation n'a été trouvée.</b></p>
            <p><a href="?page=modifresa">Ajouter une réservation</a></p>
        </div>
    </div>

<?php else : ?>
<div class="w3-row-padding w3-padding-16" style="display: flex; justify-content: center; gap: 3rem; margin-top: 4rem; margin-bottom: 4rem;">
    <?php
    $count = 0; // Initialize a counter to keep track of cards per row
    foreach ($reservations as $reservation):
    ?>
    <div class="w3-card" style="width: 500px; height: 450px; margin-right: 3rem;">
        <!-- You can customize this part with dynamic data -->
        <img src="./img/room_1.jpg" style="width:100%; height: 170px; object-fit: cover;">
        <div class="w3-container w3-white" style="height: 280px; overflow: hidden;">
            <p><b>Nom: </b><?php echo $reservation['nom']; ?></p>
            <p><b>Prénom: </b><?php echo $reservation['prenom']; ?></p>
            <p><b>Taille de la chambre: </b><?php echo $reservation['taille']; ?></p>
            <p><b>Durée du séjour: </b><?php echo $reservation['duree']; ?></p>
            <a style="text-decoration: none;" href='?page=modifresa&id=<?php echo $reservation['id']; ?>'><button class="w3-button w3-block w3-black w3-opacity">modifier la réservation</button></a>
            <a style="text-decoration: none;" href='?page=reservations&id=<?php echo $reservation['id']; ?>'><button class="w3-button w3-block w3-red w3-opacity" style="margin-top: 15px">supprimer la réservation</button></a>
        </div>
    </div>
    <?php
    $count++;
    // Check if two cards have been displayed (two cards per row)
    if ($count % 2 == 0):
    ?>
</div><div class="w3-row-padding w3-padding-16" style="display: flex; justify-content: center; gap: 3rem; margin-top: 2rem;">
    <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
