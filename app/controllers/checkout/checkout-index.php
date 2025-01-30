<?php

// Retrieve the products from the GET request
$producten = $_GET['producten'] ?? [];

// Pass the products to the view
view('checkout/checkout-index', [
    'producten' => $producten
]);
