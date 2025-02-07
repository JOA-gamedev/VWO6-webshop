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

// Handle file upload
$afbeelding_naam = $_POST['afbeelding_naam'];
$afbeelding = $_FILES['afbeelding']['name'];
$target_dir = __DIR__ . "/../../../webroot/images/";
$target_file = $target_dir . basename($afbeelding_naam . '.' . pathinfo($afbeelding, PATHINFO_EXTENSION));

// Ensure the images directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES['afbeelding']['tmp_name'], $target_file)) {
    $_SESSION['error'] = "Sorry, there was an error uploading your file.";
    header("Location: /items/items-edit?id=" . $_POST['id']);
    exit();
}

//wijzigen doorvoeren
$db = new Database();
$db->query('UPDATE producten SET naam = ?, prijs = ?, beschrijving = ?, kleur = ?, geslacht = ?, afbeelding = ? WHERE id = ?', [
    $_POST['naam'],
    floatval($_POST['prijs']),
    $_POST['beschrijving'],
    $_POST['kleur'],
    $_POST['geslacht'],
    $afbeelding_naam,
    $_POST['id']
]);

flash("Item " . htmlspecialchars($_POST['naam']) . " is gewijzigd");
//terugsturen naar de detail pagina van het item
header("location: /productbeheer");