<?php


// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
$user = $_SESSION['user'] ?? null; // Controleer of 'user' bestaat in de sessie

if ($user && isset($user['id'])) {
    $userId = $user['id'];

    // Haal de gebruikersgegevens op uit de database
    $profile = $db->query('SELECT id, email, password, name, straat, huisnr, postcode, role, created_at, updated_at, deleted_at FROM jel_bestelt.users WHERE id = ?', [$userId])->fetch();

    if (!$profile) {
        // Standaardwaarden als er geen profiel gevonden wordt
        $profile = [
            'email' => 'Niet beschikbaar',
            'name' => 'Onbekend',
            'straat' => 'Niet beschikbaar',
            'huisnr' => 'Niet beschikbaar',
            'postcode' => 'Niet beschikbaar'
        ];
    }
} else {
    // Als de gebruiker niet is ingelogd, standaardwaarden instellen
    $profile = [
        'email' => 'Niet ingelogd',
        'name' => 'Niet beschikbaar',
        'straat' => 'Niet beschikbaar',
        'huisnr' => 'Niet beschikbaar',
        'postcode' => 'Niet beschikbaar'
    ];
}

// Toon het profiel in de view
view("profiel-edit", [
    'profile' => $profile
]);
