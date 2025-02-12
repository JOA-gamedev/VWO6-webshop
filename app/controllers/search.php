<?php
//initialiseren van database class
$db = new Database();

// Haal de zoekterm op uit de URL
$query = $_GET['query'] ?? '';

// Controleer of de zoekterm aanwezig is
if ($query) {
    // Zoek in de database naar producten die overeenkomen met de zoekterm
    $items = $db->query("SELECT * FROM producten WHERE naam LIKE ? OR beschrijving LIKE ? OR kleur LIKE ?", ['%' . $query . '%', '%' . $query . '%', '%' . $query . '%'])->fetchAll();

    // Toon de view met de zoekresultaten
    view('search-results', [
        'items' => $items,
        'query' => $query
    ]);
} else {
    // Toon een lege zoekresultatenpagina als er geen zoekterm is
    view('search-results', [
        'items' => [],
        'query' => $query
    ]);
}
?>
