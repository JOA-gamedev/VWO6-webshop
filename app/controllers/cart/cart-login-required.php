<?php
// Set a session variable to indicate that the user needs to be redirected to the cart after login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['redirect_to_cart'] = true;

view('cart/cart-login-required');
?>
