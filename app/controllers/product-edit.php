<?php 

$productID = $_GET['id'] ?? null;  // Haal de productID op bij GET verzoek

// Handle GET request (ophalen van de productgegevens)
if (!$productID) {
    die("Geen product-ID opgegeven.");
}

$db = new Database();
$product = $db->query('SELECT * FROM producten WHERE id = ?', [$productID])->fetch();

if (!$product) {
    die("Product niet gevonden.");
}

view("product-edit", [
    'product' => $product,
]);

