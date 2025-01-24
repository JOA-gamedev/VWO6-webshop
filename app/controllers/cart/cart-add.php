<?php
// 1
// zorg ervoor dat je een POST request doet en je router doorverwijst naar dit bestand
// 2
// het post request bevat de volgende data:
// - id (van het product)
// 3
// Onze winkel wagen staat in de session variabele $_SESSION['winkelwagen'].

//indien er een id en een aantal is
if ($_POST['id'] ?? null) {
    //haal de winkelwagen op uit de sessie
    $winkelwagen = $_SESSION['winkelwagen'] ?? [];
    //voeg het product toe aan de winkelwagen (als het al bestaat, wordt er één opgeteld bij het aantal)
    $winkelwagen[$_POST['id']] = ($winkelwagen[$_POST['id']] ?? 0) + 1;
    //sla de winkelwagen op in de sessie
    $_SESSION['winkelwagen'] = $winkelwagen;
}
//stuur de gebruiker terug naar de vorige pagina
header('Location: ' . $_SERVER['HTTP_REFERER']);