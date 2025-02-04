<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op
$userId = $_SESSION['user']['id'] ?? null;

// Haal de bestellingen op als de gebruiker is ingelogd
$orders = [];
if ($userId) {
    $orders = $db->query(
        '
        SELECT b.*, k.percentage, 
        (SELECT SUM(br.prijs * br.aantal) FROM bestelregels br WHERE br.bestelling_id = b.id) as totaalbedrag,
        (SELECT GROUP_CONCAT(CONCAT(p.naam, " (", br.aantal, "x)") SEPARATOR ", ") 
         FROM bestelregels br 
         JOIN producten p ON br.product_id = p.id 
         WHERE br.bestelling_id = b.id) as producten 
        FROM bestellingen b 
        LEFT JOIN kortingcodes k ON b.kortingcode_id = k.id 
        WHERE b.klant_id = ? 
        ORDER BY b.created_at DESC',
        [$userId]
    )->fetchAll();
}

// Toon de bestellingen in de view
view("bestel-status", [
    'orders' => $orders
]);