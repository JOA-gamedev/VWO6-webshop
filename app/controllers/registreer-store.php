<?php
require "../src/Validator.php";


$errors = [];

if (empty($_POST['name'])) {
    $errors[] = 'Name is required';
}

if (empty($_POST['email'])) {
    $errors[] = 'Email is required';
}

if (empty($_POST['password'])) {
    $errors[] = 'Password is required';
}

if (!empty($errors)) {
    // Handle errors (e.g., display them to the user)
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
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
        view("registreer");
    } else {
        // wachtwoord hashen
        $pswrd_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // gegevens toevoegen aan de database
        $db->query("INSERT INTO users (email, password, name) VALUES (?, ?, ?)", [
            $_POST['email'],
            $pswrd_hash,
            $_POST['name'],
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
    view("registreer");
}