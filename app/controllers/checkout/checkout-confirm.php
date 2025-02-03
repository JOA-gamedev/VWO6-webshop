<?php

// Check if the order details are available in the session
if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];

    // Initialize the database
    $database = new Database();

    // Display the order confirmation details
    view('checkout/checkout-confirm', [
        'order' => $order,
        'database' => $database
    ]);
} else {
    // If no order details are available, redirect to the checkout page
    redirect('/checkout');
}
