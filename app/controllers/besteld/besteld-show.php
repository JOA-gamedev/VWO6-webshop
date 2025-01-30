<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op
$userId = $_SESSION['user']['id'] ?? null;

// Haal de bestellingen op als de gebruiker is ingelogd
$orders = [];
if ($userId) {
    $orders = $db->query('SELECT * FROM bestellingen WHERE klant_id = ?', [$userId])->fetchAll();
}
dd($orders);
// Toon de bestellingen in de view
view("besteld-show", [
    'orders' => $orders
]);
