<?php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $naam = $_POST['naam'] ?? '';
    $straat = $_POST['straat'] ?? '';
    $huisnummer = $_POST['huisnummer'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $plaats = $_POST['plaats'] ?? '';
    $kaartnummer = $_POST['kaartnummer'] ?? '';
    $vervaldatum = $_POST['vervaldatum'] ?? '';
    $cvv = $_POST['cvv'] ?? '';
    $kortingscode = $_POST['kortingscode'] ?? '';

    // Validate the form data
    $errors = [];

    if (empty($naam)) {
        $errors[] = 'Naam is verplicht';
    }

    if (empty($straat)) {
        $errors[] = 'Straat is verplicht';
    }

    if (empty($huisnummer)) {
        $errors[] = 'Huisnummer is verplicht';
    }

    if (empty($postcode)) {
        $errors[] = 'Postcode is verplicht';
    }

    if (empty($plaats)) {
        $errors[] = 'Plaats is verplicht';
    }

    if (empty($kaartnummer)) {
        $errors[] = 'Kaartnummer is verplicht';
    }

    if (empty($vervaldatum)) {
        $errors[] = 'Vervaldatum is verplicht';
    }

    if (empty($cvv)) {
        $errors[] = 'CVV is verplicht';
    }

    // Validate kortingscode if provided
    $kortingscodeData = null;
    if (!empty($kortingscode)) {
        $database = new Database();
        $kortingscodeData = $database->query('SELECT * FROM kortingscodes WHERE code = ?', [$kortingscode])->fetch();
        if (!$kortingscodeData) {
            $errors[] = 'Ongeldige kortingscode';
        }
    }

    if (!empty($errors)) {
        // Handle errors (e.g., display them to the user)
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        exit;
    }

    // Initialize the database
    $database = new Database();

    // Create a new order
    $database->query('INSERT INTO bestellingen (klant_id, straat, huisnr, postcode, plaats, status) VALUES (?, ?, ?, ?, ?, ?)', [
        user()->id,
        $straat,
        $huisnummer,
        $postcode,
        $plaats,
        'betaald',
    ]);

    // Retrieve the order ID
    $bestelling_id = $database->lastInsertId();

    // Calculate the total amount
    $totaalbedrag = 0;
    foreach ($_SESSION['winkelwagen'] as $id => $aantal) {
        $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        $totaalbedrag += $product['prijs'] * $aantal;
    }

    // Apply the discount if a valid kortingscode is provided
    if ($kortingscodeData) {
        $percentage = $kortingscodeData['percentage'] / 100;
        $totaalbedrag *= (1 - $percentage);
    }

    // Loop through the cart items and save the order lines
    foreach ($_SESSION['winkelwagen'] as $id => $aantal) {
        $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        $database->query('INSERT INTO bestelregels (bestelling_id, product_id, prijs, aantal) VALUES (?, ?, ?, ?)', [
            $bestelling_id,
            $id,
            $product['prijs'],
            $aantal
        ]);
    }

    // Clear the cart
    unset($_SESSION['winkelwagen']);

    // Provide a confirmation to the user
    flash('Bedankt voor uw bestelling. Totaal bedrag: €' . number_format($totaalbedrag, 2, ',', '.'));

    // Redirect the user to the order confirmation page
    redirect('/bestel-status');
} else {
    // If the request is not a POST request, redirect to the home page
    redirect('/');
}
