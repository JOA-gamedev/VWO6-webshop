<?php


// Verbind met de database
$db = new Database();



// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
    $user = $_SESSION['user'] ?? null;

    if ($user && isset($user['id'])) {
        $userId = $user['id'];

        // Voer een hard delete uit door de gebruiker volledig te verwijderen
        $db->query(
            'DELETE FROM users WHERE id = ?',
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
