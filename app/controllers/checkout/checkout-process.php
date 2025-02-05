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
    $kortingcode = $_SESSION['kortingscode']['code'] ?? null;

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

    // Validate kortingcode if provided
    $kortingcodeData = null;
    if (!empty($kortingcode)) {
        $database = new Database();
        $kortingcodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingcode])->fetch();
        if (!$kortingcodeData) {
            $errors[] = 'Ongeldige kortingcode';
        }
    }

    if (!empty($errors)) {
        // Handle errors (e.g., display them to the user)
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        exit;
    }

    $database = new Database(); // Initialize the database

    // Calculate the total amount
    $totaalbedrag = 0;
    foreach ($_SESSION['winkelwagen'] as $key => $aantal) {
        list($id, $size) = explode('-', $key);
        $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        $totaalbedrag += $product['prijs'] * $aantal;
    }

    // Apply the discount if a valid kortingcode is provided
    if ($kortingcodeData) {
        $percentage = $kortingcodeData['percentage'] / 100;
        $totaalbedrag *= (1 - $percentage);
        unset($_SESSION['kortingscode']); // Ensure the discount code is applied only once
        $_SESSION['flash_message'] = 'Kortingcode toegepast!';
    }

    // Save the order details in the session
    $_SESSION['order'] = [
        'naam' => $naam,
        'straat' => $straat,
        'huisnummer' => $huisnummer,
        'postcode' => $postcode,
        'plaats' => $plaats,
        'kaartnummer' => $kaartnummer,
        'vervaldatum' => $vervaldatum,
        'cvv' => $cvv,
        'totaalbedrag' => $totaalbedrag,
        'kortingcode' => $kortingcodeData
    ];

    // Redirect to the order confirmation page
    redirect('/checkout/confirm');
} else {
    // If the request is not a POST request, redirect to the home page
    redirect('/');
}
