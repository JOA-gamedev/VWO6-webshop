<?php
// cart.php
session_start();

function addToCart($itemId) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Controleer of $itemId een geldige integer is
    $itemId = filter_var($itemId, FILTER_VALIDATE_INT);
    if ($itemId !== false) {
        $_SESSION['cart'][] = $itemId;
    } else {
        // Foutafhandeling als item_id niet geldig is
        echo "Ongeldig item ID.";
    }
}

function getCartItems() {
    if (!isset($_SESSION['cart'])) {
        return [];
    }
    return $_SESSION['cart'];
}
?>
