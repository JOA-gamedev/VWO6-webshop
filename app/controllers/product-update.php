<?php

// Haal het productID op uit de querystring
 // Haal de waarde van 'id' uit de URI

// Haal de POST-waarden op
$productID = $_POST['id'] ?? null; // werkt
$naam = $_POST['naam'] ?? null;
$prijs = $_POST['prijs'] ?? null;
$beschrijving = $_POST['beschrijving'] ?? null;

// Controleer of het productID en de andere velden aanwezig zijn

if (!$productID || !$naam || !$prijs || !$beschrijving) {
    die("Alle velden zijn verplicht.");
}

$db = new Database();
// Update het product in de database
$db->query('UPDATE producten SET naam = ?, prijs = ?, beschrijving = ? WHERE id = ?', [
    $naam, $prijs, $beschrijving, $productID
]);

flash("Wijzigingen Opgeslagen: " . htmlspecialchars($naam), true);
header("Location: /");
exit;
