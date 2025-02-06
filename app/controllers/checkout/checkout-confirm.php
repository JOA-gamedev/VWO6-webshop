<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    $kortingscode = $order['kortingcode'] ?? null;

    // Retrieve the original amount from the database
    $originalAmount = 0;
    foreach ($_SESSION['winkelwagen'] as $key => $aantal) {
        list($id, $size) = explode('-', $key);
        $product = $database->query('SELECT prijs FROM producten WHERE id = :id', [':id' => $id])->fetch();
        $originalAmount += $product['prijs'] * $aantal;
    }

    if (isset($kortingscode['percentage'])) {
        $discountAmount = $originalAmount * ($kortingscode['percentage'] / 100);
        $totalAmount = $originalAmount - $discountAmount;
    } else {
        $discountAmount = 0;
        $totalAmount = $originalAmount;
    }

    $originalAmount = floatval(str_replace(',', '.', $originalAmount)); // Ensure it's a float
    $discountAmount = floatval(str_replace(',', '.', $discountAmount)); // Ensure it's a float
    $totalAmount = floatval(str_replace(',', '.', $totalAmount)); // Ensure it's a float

    // Retrieve the products from the session
    $producten = [];
    foreach ($_SESSION['winkelwagen'] as $key => $aantal) {
        list($id, $size) = explode('-', $key);
        $product = $database->query('SELECT * FROM producten WHERE id = :id', [':id' => $id])->fetch();
        $product['aantal'] = $aantal;
        $product['maat'] = $size;
        $product['totaal'] = $product['prijs'] * $aantal;
        $producten[] = $product;
    }

    // Store the new total amount in the database
    if (isset($order['id'])) {
        $database->query('UPDATE bestellingen SET totaal_bedrag = :totaalbedrag WHERE id = :id', [
            ':totaalbedrag' => $totalAmount,
            ':id' => $order['id']
        ]);

        // Store the new total amount and kortingcode_id in the bestelregels table
        foreach ($producten as $product) {
            $discountedTotal = $product['totaal'];
            if (isset($kortingscode['percentage'])) {
                $discountedTotal *= (1 - ($kortingscode['percentage'] / 100));
            }
            $database->query('UPDATE bestelregels SET totaalbedrag = :totaalbedrag, kortingcode_id = :kortingcode_id WHERE bestelling_id = :bestelling_id AND product_id = :product_id', [
                ':totaalbedrag' => number_format($discountedTotal, 2, ',', '.'),
                ':kortingcode_id' => $kortingscode['id'] ?? null,
                ':bestelling_id' => $order['id'],
                ':product_id' => $product['id']
            ]);
        }
    }

    // Display the order confirmation details
    view('checkout/checkout-confirm', [
        'order' => $order,
        'database' => $database,
        'kortingscode' => $kortingscode,
        'originalAmount' => number_format($originalAmount, 2, ',', '.'),
        'discountAmount' => number_format($discountAmount, 2, ',', '.'),
        'totalAmount' => number_format($totalAmount, 2, ',', '.'),
        'producten' => $producten
    ]);
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}