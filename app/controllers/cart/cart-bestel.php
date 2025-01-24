<?php
//we gaan nu alle producten uit de winkelwagen ophalen en in de database opslaan als bestelling
//Daarna maken we de winkelwagen leeg

//Maak een bestelling aan
$database = new Database();
$database->query('INSERT INTO bestellingen (klant_id, status) VALUES (?,?,?)', [
    user()->id,
    'betaald',
]);

//haal het bestelling_id op
$bestelling_id = $database->lastInsertId();

//doorloop de winkelwagen en vul de bestelregels
foreach ($_SESSION['winkelwagen'] as $id => $aantal) {
    //sla de bestelregel op
    $database->query('INSERT INTO bestelregels (bestelling_id, product_id, aantal) VALUES (?,?,?)', [
        $bestelling_id,
        $id,
        $aantal,
    ]);
}

//maak de winkelwagen leeg
unset($_SESSION['winkelwagen']);

//geef de gebruiker een bevestiging
flash('Bedankt voor uw bestelling');

//stuur de gebruiker naar een pagina
redirect('...');