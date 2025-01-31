<?php


// Verbind met de database
$db = new Database();

// Start de sessie (indien nog niet gestart)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
    $user = $_SESSION['user'] ?? null;

    if ($user && isset($user['id'])) {
        $userId = $user['id'];

        // Voer een hard delete uit door de gebruiker volledig te verwijderen
        $db->query(
            'UPDATE jel_bestelt.users SET deleted_at = ? WHERE id = ?',
            ['2025-01-31 16:49:26', $userId]
        );

        // Log de gebruiker uit
        unset($_SESSION['user']);
        session_destroy();

        // Redirect naar de homepagina of een bevestigingspagina
        header('Location: /');
        exit;
    } else {
        http_response_code(403);
        view('403', ['error' => 'Toegang geweigerd.']);
        die();
    }
}
