<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    // Create a new order
    $database->query('INSERT INTO bestellingen (klant_id, straat, huisnr, postcode, plaats, status, kortingcode_id) VALUES (?, ?, ?, ?, ?, ?, ?)', [
        user()->id,
        $order['straat'],
        $order['huisnummer'],
        $order['postcode'],
        $order['plaats'],
        'betaald',
        $order['kortingcode']['id'] ?? null
    ]);

    // Retrieve the order ID
    $bestelling_id = $database->lastInsertId();

    // Loop through the cart items and save the order lines
    foreach ($_SESSION['winkelwagen'] as $id => $aantal) {
        $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        $prijs = $product['prijs'];
        
        // Apply the discount to each product price if a valid kortingcode is provided
        if ($order['kortingcode']) {
            $percentage = $order['kortingcode']['percentage'] / 100;
            $prijs *= (1 - $percentage);
        }

        $database->query('INSERT INTO bestelregels (bestelling_id, product_id, prijs, aantal, kortingcode_id) VALUES (?, ?, ?, ?, ?)', [
            $bestelling_id,
            $id,
            $prijs,
            $aantal,
            $order['kortingcode']['id'] ?? null
        ]);
    }

    // Clear the cart and order details from the session
    unset($_SESSION['winkelwagen']);
    unset($_SESSION['order']);

    // Provide a confirmation to the user
    flash('Bedankt voor uw bestelling. Totaal bedrag: €' . number_format($order['totaalbedrag'], 2, ',', '.'));

    // Redirect the user to the order status page
    redirect('/bestel-status');
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}
