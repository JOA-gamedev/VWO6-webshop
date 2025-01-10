<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
$user = $_SESSION['user'] ?? null; // Controleer of 'user' bestaat in de sessie

if ($user && isset($user['id'])) {
    $userId = $user['id'];

    // Bereid de SQL-query voor
    $temp = $db->query('SELECT status FROM bestellingen WHERE klant_id = ?', [$userId])->fetch();
    $orderStatus = $temp['status'];

    if (!$orderStatus) {
        $orderStatus = 'Geen status beschikbaar'; // Standaardwaarde als er geen resultaten zijn
    }
} else {
    $orderStatus = 'Geen status beschikbaar'; // Als de gebruiker niet is ingelogd
}

// Toon de bestelstatus in de view
view("bestel-status", [
    'orderStatus' => $orderStatus
]);
