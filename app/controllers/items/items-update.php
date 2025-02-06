<?php
//validatie van de gegevens
require "../src/Validator.php";
$errors = []; //lege array voor de foutmeldingen

if (!Validator::required($_POST['naam'])) {
    $errors['naam'] = "Naam is verplicht";
}
if (!Validator::length($_POST['naam'], 0, 50)) {
    $errors['naam'] = "Naam mag niet langer zijn dan 50 tekens";
}
if (!Validator::between($_POST['prijs'], 0.01, 1000000)) {
    $errors['naam'] = "De prijs moet tussen 0,01 en 1.000.000 liggen";
}
//voor alle validatie regels zie cheat-sheet

//indien niet oké terugsturen naar de create pagina met foutmeldingen
if (!empty($errors)) {
    view('items-edit', [
        'errors' => $errors,
        'item' => $_POST,
    ]);
    exit();
}

//wijzigen doorvoeren
$db = new Database();
$afbeelding = $_FILES['afbeelding']['name'];
$afbeelding_naam = $_POST['afbeelding_naam'];

// Use the provided filename
$afbeelding = $afbeelding_naam . '.' . pathinfo($afbeelding, PATHINFO_EXTENSION);

// Sanitize the file name
$afbeelding = preg_replace('/\.(?=.*\.)/', '', $afbeelding);
$target_dir = __DIR__ . "/../../../webroot/images/";
$target_file = $target_dir . basename($afbeelding);

// Ensure the images directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], $target_file)) {
    $updated_at = date('Y-m-d H:i:s');

    // Update product in the database
    $db->query('UPDATE producten SET naam = ?, prijs = ?, beschrijving = ?, kleur = ?, geslacht = ?, afbeelding = ?, updated_at = ? WHERE id = ?', [
        $_POST['naam'],
        floatval($_POST['prijs']),
        $_POST['beschrijving'],
        $_POST['kleur'],
        $_POST['geslacht'],
        $afbeelding,
        $updated_at,
        $_POST['id']
    ]);

    flash("Item " . htmlspecialchars($_POST['naam']) . " is gewijzigd");
    //terugsturen naar de detail pagina van het item
    header("location: /productbeheer");
} else {
    // Handle case where no new image is uploaded
    $updated_at = date('Y-m-d H:i:s');

    // Update product in the database without changing the image
    $db->query('UPDATE producten SET naam = ?, prijs = ?, beschrijving = ?, kleur = ?, geslacht = ?, updated_at = ? WHERE id = ?', [
        $_POST['naam'],
        floatval($_POST['prijs']),
        $_POST['beschrijving'],
        $_POST['kleur'],
        $_POST['geslacht'],
        $updated_at,
        $_POST['id']
    ]);

    flash("Item " . htmlspecialchars($_POST['naam']) . " is gewijzigd");
    //terugsturen naar de detail pagina van het item
    header("location: /productbeheer");
}