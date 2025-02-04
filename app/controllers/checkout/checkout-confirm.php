<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    $kortingscode = $_SESSION['kortingscode'] ?? null;

    if (isset($kortingscode['percentage'])) {
        // de code hieronder heb ik niet geschreven maar van jens gekregen

        //hier word de prijs berekend van alle items in de kart
        //dat is dus overbodig want we hebben al de totaalprijs van de order
        // $originalAmount = array_reduce(array_keys($_SESSION['winkelwagen']), function ($carry, $id) use ($database) {
        //     $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
        //     return $carry + ($product ? $product['prijs'] * $_SESSION['winkelwagen'][$id] : 0);
        // }, 0);
        // $discountAmount = $originalAmount - $order['totaalbedrag'];

        //deze code is van mij
        $originalAmount = $order['totaalbedrag'];
        $discountAmount = $originalAmount * ($kortingscode['percentage'] / 100);
        $totalAmount = $originalAmount - $discountAmount;
    } else {
        $originalAmount = $order['totaalbedrag'];
        $discountAmount = 0;
        $totalAmount = $originalAmount;
    }

    

    // Display the order confirmation details
    view('checkout/checkout-confirm', [
        'order' => $order,
        'database' => $database,
        'kortingscode' => $kortingscode,
        'originalAmount' => $originalAmount,
        'discountAmount' => $discountAmount,
        'totalAmount' => $totalAmount
    ]);
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}