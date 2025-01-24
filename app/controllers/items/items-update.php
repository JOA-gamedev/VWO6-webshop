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
$db->query("UPDATE items SET naam = :naam, beschrijving = :beschrijving, prijs = :prijs WHERE id = :id", [
    'naam' => $_POST['naam'],
    'beschrijving' => $_POST['beschrijving'],
    'prijs' => $_POST['prijs'],
    'id' => $_POST['id']
]);

flash("Item " . htmlspecialchars($_POST['naam']) . " is gewijzigd");
//terugsturen naar de detail pagina van het item
header("location: /items/" . $_POST['id']);