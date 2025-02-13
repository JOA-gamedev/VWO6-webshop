<?php
// Verbind met de database
$db = new Database();

// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
    $user = $_SESSION['user'] ?? null;

    if ($user && isset($user['id'])) {
        $userId = $user['id'];

        // Valideer en filter de ingevoerde gegevens
        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $straat = trim($_POST['straat'] ?? '');
        $huisnr = trim($_POST['huisnr'] ?? '');
        $postcode = trim($_POST['postcode'] ?? '');
        $plaats = trim($_POST['plaats'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';

        if ($name === '' || !$email || $straat === '' || $huisnr === '' || $postcode === '' || $plaats === '') {
            flash('Ongeldige invoer. Controleer uw gegevens.', false, 3000);
            view('profiel-edit', [
                'profile' => [
                    'name' => htmlspecialchars($name),
                    'email' => htmlspecialchars($email),
                    'straat' => htmlspecialchars($straat),
                    'huisnr' => htmlspecialchars($huisnr),
                    'postcode' => htmlspecialchars($postcode),
                    'plaats' => htmlspecialchars($plaats)
                ]
            ]);
            die();
        }

        // Werk de gebruikersgegevens bij in de database
        $db->query(
            'UPDATE users SET name = ?, email = ?, straat = ?, huisnr = ?, postcode = ?, plaats = ? WHERE id = ?',
            [$name, $email, $straat, $huisnr, $postcode, $plaats, $userId]
        );
        flash('Profiel succesvol bijgewerkt.', true, 3000);

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