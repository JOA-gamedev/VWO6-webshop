<?php
require "../src/Validator.php";

// Start de sessie (indien nog niet gestart)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!Validator::required($_POST['email'])) {
    $errors['login'] = "Email mag niet leeg zijn";
}
if (!Validator::required($_POST['password'])) {
    $errors['login'] = "Wachtwoord mag niet leeg zijn";
}
if (empty($errors)) {
    $db = new Database();
    //gebruiker ophalen uit de database
    $user = $db->query("SELECT * FROM users WHERE email = ? LIMIT 1", [
        $_POST['email']
    ])->fetch();
    //als er een gebruiker is gevonden
    if ($user) {
        //wachtwoord controleren
        if (password_verify($_POST['password'], $user['password'])) {

            // Controleer of het profiel is verwijderd
            if ($user['deleted_at'] !== null) {
                flash('Uw account is gedeactiveerd. Neem contact op met de beheerder.', false, 3000);
                header('Location: /login');
                exit;
            }

            //gebruiker in session zetten, maar het wachtwoord laten we weg
            unset($user['password']);
            $_SESSION['user'] = $user;

            flash("Welkom terug " . $user['name'], true);
            //doorsturen naar de home pagina (of pas aan)
            header("Location: /");
            exit;
        } else {
            $errors['login'] = "Inloggegevens zijn niet correct";
        }
    } else {
        $errors['login'] = "Inloggegevens zijn niet correct";
    }
}
view("login", [
    'errors' => $errors,
]);