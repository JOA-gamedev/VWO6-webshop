<?php
//1
//zorg ervoor dat je een POST request doet en je router doorverwijst naar dit bestand
//2
//het post request bevat de volgende data:
// - id (van het product)

//indien er een id is
if ($_POST['id'] ?? null) {
    //haal de winkelwagen op uit de sessie
    $winkelwagen = $_SESSION['winkelwagen'] ?? [];
    //voeg het product toe aan de winkelwagen (als het al bestaat, tel het aantal op)
    $winkelwagen[$_POST['id']] -= 1;
    //als er geen producten meer zijn, verwijder het product uit de winkelwagen
    if ($winkelwagen[$_POST['id']] <= 0) {
        unset($winkelwagen[$_POST['id']]);
    }
    //sla de winkelwagen op in de sessie
    $_SESSION['winkelwagen'] = $winkelwagen;
}
//stuur de gebruiker terug naar de vorige pagina
header('Location: ' . $_SERVER['HTTP_REFERER']);