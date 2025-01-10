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

        // Valideer en filter de ingevoerde gegevens
        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';

        if ($name === '' || !$email) {
            flash('Ongeldige invoer. Controleer uw naam en e-mailadres.', false, 3000);
            view('profiel-edit', [
                'profile' => [
                    'name' => htmlspecialchars($name),
                    'email' => htmlspecialchars($email)
                ],
                'csrfToken' => $_SESSION['csrf_token']
            ]);
            die();
        }

        // Werk de gebruikersgegevens bij in de database
        $db->query(
            'UPDATE users SET name = ?, email = ? WHERE id = ?',
            [$name, $email, $userId]
        );
        flash('Naam en e-mail succesvol bijgewerkt.', true, 3000);

        // Werk het wachtwoord bij als beide velden zijn ingevuld en overeenkomen
        if ($password !== '' && $password === $password_confirmation) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $db->query(
                'UPDATE users SET password = ? WHERE id = ?',
                [$hashed_password, $userId]
            );
            flash('Wachtwoord succesvol bijgewerkt.', true, 3000);
        }

        // Redirect naar een bevestigingspagina of terug naar het profiel
        flash('Profiel succesvol bijgewerkt.', true, 3000);
        header('Location: /profiel-edit');
        exit;
    } else {
        http_response_code(403);
        view('403', ['error' => 'Toegang geweigerd.']);
        die();
    }
}