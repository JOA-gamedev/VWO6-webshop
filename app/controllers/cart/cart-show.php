<?php
//sessie $_SESSION['winkelwagen'] verrijken met producten
//gegevens meegeven aan de view

$producten = []; //lege array voor de producten uit de winkelwagen
$totaal = 0; //totaalprijs van de winkelwagen

if (isset($_SESSION['winkelwagen'])) { //indien er een winkelwagen is
    $database = new Database();
    $winkelwagen = $_SESSION['winkelwagen'];

    foreach ($winkelwagen as $id => $aantal) { //doorloop de winkelwagen
        $product = $database->query('SELECT * FROM producten WHERE id = :id', [':id' => $id])->fetch();
        $product['aantal'] = $aantal; //aantal toevoegen aan het product
        $product['totaal'] = $product['prijs'] * $aantal; //totaalprijs berekenen van het betreffende product
        $producten[] = $product; //toeven aan de producten array
        $totaal += $product['totaal']; //totaalprijs verhogen met de totaalprijs van het betreffende product
    }
    $totaal = number_format($totaal, 2, ',', '.');
}

view('winkelwagen-show', [
    'producten' => $producten,
    'totaal' => $totaal
]); //gegevens meegeven aan de view

/*
 * In de view kan je nu de producten array doorlopen en de gegevens tonen
 * De array bevat alle producten uit de winkelwagen met alle kolommen uit de database
 * verrijkt met het aantal en de totaalprijs (totaal)
 * De totaalprijs is opgemaakt met number_format en is het totaalbedrag van de winkelwagen
 *
 * Uiteraard kan je hier nog een mooie kortingscode aan toevoegen
 *
 * */