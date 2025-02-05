<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the required POST data is present
if ($_POST['id'] ?? null && $_POST['size'] ?? null && $_POST['quantity'] ?? null) {
    // Get the cart from the session
    $cart = $_SESSION['winkelwagen'] ?? [];
    $oldKey = $_POST['id'] . '-' . $_POST['old_size'];
    $newKey = $_POST['id'] . '-' . $_POST['size'];

    // Remove the old product entry
    if (isset($cart[$oldKey])) {
        unset($cart[$oldKey]);
    }

    // Update the quantity
    $cart[$newKey] = $_POST['quantity'];

    // Save the cart back to the session
    $_SESSION['winkelwagen'] = $cart;
}

// Redirect the user back to the cart page
header('Location: /cart');
