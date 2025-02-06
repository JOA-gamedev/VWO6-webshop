<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    // Calculate the total amount with discount if applicable
    $totalAmount = $order['totaalbedrag'];
    $kortingscode = $order['kortingcode'] ?? null;

    if ($kortingscode) {
        $percentage = $kortingscode['percentage'] / 100;
        $totalAmount = $totalAmount * (1 - $percentage);
        unset($_SESSION['kortingscode']); // Ensure the discount code is applied only once
    }

    // Create a new order
    $database->query('INSERT INTO bestellingen (klant_id, straat, huisnr, postcode, plaats, status, kortingcode_id) VALUES (?, ?, ?, ?, ?, ?, ?)', [
        user()->id,
        $order['straat'],
        $order['huisnummer'],
        $order['postcode'],
        $order['plaats'],
        'betaald',
        $kortingscode['id'] ?? null
    ]);

    // Retrieve the order ID
    $bestelling_id = $database->lastInsertId();

    // Loop through the cart items and save the order lines
    foreach ($_SESSION['winkelwagen'] as $key => $aantal) {
        list($id, $size) = explode('-', $key);
        $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        $prijs = $product['prijs'];
        
        // Apply the discount to each product price if a valid kortingcode is provided
        if ($kortingscode) {
            $percentage = $kortingscode['percentage'] / 100;
            $prijs *= (1 - $percentage);
        }

        $totaalbedrag = $prijs * $aantal;

        $database->query('INSERT INTO bestelregels (bestelling_id, product_id, prijs, aantal, kortingcode_id, totaalbedrag, maat) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $bestelling_id,
            $id,
            $prijs,
            $aantal,
            $kortingscode['id'] ?? null,
            $totaalbedrag,
            $size
        ]);
    }

    // Clear the cart and order details from the session
    unset($_SESSION['winkelwagen']);
    unset($_SESSION['order']);
    unset($_SESSION['kortingscode']); // Clear the discount code from the session

    // Provide a confirmation to the user
    flash('Bedankt voor uw bestelling. Totaal bedrag: €' . number_format($totaalbedrag, 2, ',', '.'));

    // Redirect the user to the order status page
    redirect('/bestel-status');
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}