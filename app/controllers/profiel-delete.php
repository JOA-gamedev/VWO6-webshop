<?php


// Verbind met de database
$db = new Database();

// Start de sessie (indien nog niet gestart)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer het CSRF-token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(401);
        view('401', ['error' => 'CSRF-token mismatch error.']);
        die();
    }

    // Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
    $user = $_SESSION['user'] ?? null;

    if ($user && isset($user['id'])) {
        $userId = $user['id'];

        // Voer een soft delete uit door de gebruiker als inactief te markeren
        $db->query(
            'UPDATE users SET deleted_at = NOW() WHERE id = ?',
            [$userId]
        );

        // Redirect naar de homepagina of een bevestigingspagina
        flash('Profiel succesvol verwijderd.', true, 3000);
        header('Location: /');
        exit;
    } else {
        http_response_code(403);
        view('403', ['error' => 'Toegang geweigerd.']);
        die();
    }
}
