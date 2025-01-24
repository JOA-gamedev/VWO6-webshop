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
    view('items-create', [
        'errors' => $errors
    ]);
    exit();
}

//indien validatie oké dan gegevens opslaan in de database
$db = new Database();
$db->query("INSERT INTO items (naam,beschrijving,prijs) VALUES (:naam,:beschrijving,:prijs)", [
    'naam' => $_POST['naam'],
    'beschrijving' => $_POST['beschrijving'],
    'prijs' => $_POST['prijs']
]); //id veld staat op auto increment dus hoeft niet meegegeven te worden

flash("Item " . htmlspecialchars($_POST['naam']) . " is toegevoegd");
//terugsturen naar de index pagina
header("location: /items");

//terugsturen naar de detail pagina van het item
//header("location: /items/" . $db->lastInsertId());
