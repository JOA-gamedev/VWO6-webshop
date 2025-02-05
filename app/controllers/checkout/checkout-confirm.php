<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    $kortingscode = $_SESSION['kortingscode'] ?? null;

    if (isset($kortingscode['percentage'])) {
        $originalAmount = $order['totaalbedrag'];
        $discountAmount = $originalAmount * ($kortingscode['percentage'] / 100);
        $totalAmount = $originalAmount - $discountAmount;
    } else {
        $originalAmount = $order['totaalbedrag'];
        $discountAmount = 0;
        $totalAmount = $originalAmount;
    }

    $totalAmount = floatval(str_replace(',', '.', $totalAmount)); // Ensure it's a float
    $totalAmount = number_format($totalAmount, 2, ',', '.'); // Ensure 2 decimal places

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

    // Display the order confirmation details
    view('checkout/checkout-confirm', [
        'order' => $order,
        'database' => $database,
        'kortingscode' => $kortingscode,
        'originalAmount' => $originalAmount,
        'discountAmount' => $discountAmount,
        'totalAmount' => $totalAmount,
        'producten' => $producten
    ]);
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}