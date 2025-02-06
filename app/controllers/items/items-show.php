<?php
//initialiseren van database class
$db = new Database();

// Haal het item-ID op uit de URL
$itemId = $_GET['id'] ?? null;

// Controleer of het item-ID aanwezig is
if ($itemId) {
    // Haal het item op uit de database
    $item = $db->query("SELECT * FROM producten WHERE id=?", [$itemId])->fetch();

    // Controleer of het item bestaat
    if ($item) {
        // Toon de view met het item
        view('items/items-show', [
            'item' => $item
        ]);
    } else {
        // Toon een 404-pagina als het item niet bestaat
        http_response_code(404);
        view("404", ['error' => "Item niet gevonden"]);
    }
} else {
    // Toon een 404-pagina als het item-ID niet aanwezig is
    http_response_code(404);
    view("404", ['error' => "Item niet gevonden"]);
}
?>