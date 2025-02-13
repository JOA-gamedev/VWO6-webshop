<?php

// Verbind met de database
$db = new Database();

// Haal het ingelogde gebruikers-ID op (bijvoorbeeld uit de sessie)
$user = $_SESSION['user'] ?? null; // Controleer of 'user' bestaat in de sessie

if ($user && isset($user['id'])) {
    $userId = $user['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $newPasswordConfirmation = $_POST['new_password_confirmation'];

        // Haal de huidige wachtwoordhash op uit de database
        $userRecord = $db->query('SELECT password FROM users WHERE id = ?', [$userId])->fetch();

        if ($userRecord && password_verify($currentPassword, $userRecord['password'])) {
            if ($newPassword === $newPasswordConfirmation) {
                // Update het wachtwoord in de database
                $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                $db->query('UPDATE users SET password = ? WHERE id = ?', [$newPasswordHash, $userId]);

                $_SESSION['flash_message'] = 'Wachtwoord succesvol aangepast.';
                $_SESSION['flash_message_type'] = 'success';
            } else {
                $_SESSION['flash_message'] = 'Nieuw wachtwoord en bevestiging komen niet overeen.';
                $_SESSION['flash_message_type'] = 'error';
            }
        } else {
            $_SESSION['flash_message'] = 'Huidig wachtwoord is onjuist.';
            $_SESSION['flash_message_type'] = 'error';
        }
    }
} else {
    $_SESSION['flash_message'] = 'Gebruiker niet ingelogd.';
    $_SESSION['flash_message_type'] = 'error';
}

// Redirect naar wachtwoord aanpassen pagina
header('Location: /wachtwoord-aanpassen');
exit;
