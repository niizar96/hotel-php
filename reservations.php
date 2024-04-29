<?php
// Function to load reservations from the text file
function loadReservations() {
    $reservations = [];
    $file = fopen("reservations.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode(",", $line);
            $reservation = [
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

$reservations = loadReservations();
?>

<div class="w3-row-padding w3-padding-16 " style="margin-top: 4rem; margin-bottom: 4rem ">
    <?php foreach ($reservations as $reservation): ?>
        <div class="w3-card">
            <!-- You can customize this part with dynamic data -->
            <div class="w3-container w3-white">
                <h3><?php echo $reservation['nom']; ?></h3>
                <p>Taille de la chambre: <?php echo $reservation['taille']; ?></p>
                <p>Durée du séjour: <?php echo $reservation['duree']; ?></p>
                <button class="w3-button w3-block w3-black w3-margin-bottom w3-opacity">Choisir la chambre</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
