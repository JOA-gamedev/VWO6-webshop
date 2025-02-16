<?php
require "../src/Validator.php";


$errors = [];

if (empty($_POST['name'])) {
    $errors['name'] = 'Naam is verplicht';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'E-mailadres is verplicht';
}

if (empty($_POST['password'])) {
    $errors['password'] = 'Wachtwoord is verplicht';
}

if (empty($_POST['straat'])) {
    $errors['straat'] = 'Straat is verplicht';
}

if (empty($_POST['huisnr'])) {
    $errors['huisnr'] = 'Huisnummer is verplicht';
}

if (empty($_POST['postcode'])) {
    $errors['postcode'] = 'Postcode is verplicht';
}

if (empty($_POST['plaats'])) {
    $errors['plaats'] = 'Plaats is verplicht';
}

if (!empty($errors)) {
    // Return errors to the view
    view("registreer", ['errors' => $errors]);
    exit;
}

if ($_POST != null) {
    $db = new Database();
    
    // Check if email already exists
    $existingUser = $db->query("SELECT * FROM users WHERE email = ?", [
        $_POST['email']
    ])->fetch();

    if ($existingUser) {
        // Set a flash message and redirect back to the registration form
        flash("E-mail adres is al in gebruik.", false, 3000);
        view("registreer", ['errors' => $errors]);
    } else {
        // wachtwoord hashen
        $pswrd_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // gegevens toevoegen aan de database
        $db->query("INSERT INTO users (email, password, name, straat, huisnr, postcode, plaats, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $_POST['email'],
            $pswrd_hash,
            $_POST['name'],
            $_POST['straat'],
            $_POST['huisnr'],
            $_POST['postcode'],
            $_POST['plaats'],
        ]);

        // Automatically log in the user
        $user = $db->query("SELECT * FROM users WHERE email = ? LIMIT 1", [
            $_POST['email']
        ])->fetch();

        if ($user) {
            unset($user['password']);
            $_SESSION['user'] = $user;

            // Check if the user came from the cart page
            if (isset($_SESSION['redirect_to_cart']) && $_SESSION['redirect_to_cart']) {
                unset($_SESSION['redirect_to_cart']);
                header('Location: /cart');
                exit;
            }

            // Check if the user needs to be redirected to the checkout page
            if (isset($_SESSION['redirect_to_checkout']) && $_SESSION['redirect_to_checkout']) {
                unset($_SESSION['redirect_to_checkout']);
                header('Location: /checkout');
                exit;
            }

            flash("Welkom " . $user['name'], true);
            header("Location: /");
            exit;
        }
    }
} else {
    view("registreer", ['errors' => $errors]);
}