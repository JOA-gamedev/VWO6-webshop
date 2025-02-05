<?php
//1
//zorg ervoor dat je een POST request doet en je router doorverwijst naar dit bestand
//2
//het post request bevat de volgende data:
// - id (van het product)
// - size (van het product)

//indien er een id en een maat is
if ($_POST['id'] ?? null && $_POST['size'] ?? null) {
    //haal de winkelwagen op uit de sessie
    $winkelwagen = $_SESSION['winkelwagen'] ?? [];
    //voeg het product toe aan de winkelwagen (als het al bestaat, tel het aantal op)
    $key = $_POST['id'] . '-' . $_POST['size'];
    $winkelwagen[$key] -= 1;
    //als er geen producten meer zijn, verwijder het product uit de winkelwagen
    if ($winkelwagen[$key] <= 0) {
        unset($winkelwagen[$key]);
    }
    //sla de winkelwagen op in de sessie
    $_SESSION['winkelwagen'] = $winkelwagen;
}
//stuur de gebruiker terug naar de vorige pagina
header('Location: ' . $_SERVER['HTTP_REFERER']);