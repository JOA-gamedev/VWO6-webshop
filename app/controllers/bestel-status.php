<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op
$userId = $_SESSION['user']['id'] ?? null;

// Haal de bestellingen op als de gebruiker is ingelogd
$orders = [];
if ($userId) {
    $orders = $db->query('
        SELECT b.*, k.percentage 
        FROM bestellingen b 
        LEFT JOIN kortingcodes k ON b.kortingcode_id = k.id 
        WHERE b.klant_id = ?', [$userId])->fetchAll();
}

// Toon de bestellingen in de view
view("bestel-status", [
    'orders' => $orders
]);
