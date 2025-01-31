<?php

// Retrieve the products from the GET request
$producten = $_GET['producten'] ?? [];

// Retrieve the user's profile data
$profile = [
    'naam' => user()->name ?? '',
    'straat' => user()->straat ?? '',
    'huisnummer' => user()->huisnr ?? '',
    'postcode' => user()->postcode ?? '',
    'plaats' => user()->plaats ?? '',
];

// Calculate the total amount
$totaalbedrag = 0;
foreach ($producten as $product) {
    $totaalbedrag += $product['totaal'] ?? 0;
}

// Apply the discount if a valid kortingscode is provided
if (isset($_SESSION['kortingscode'])) {
    $percentage = $_SESSION['kortingscode']['percentage'] / 100;
    $totaalbedrag *= (1 - $percentage);
}

// Pass the products, profile data, and total amount to the view
view('checkout/checkout-index', [
    'producten' => $producten,
    'profile' => $profile,
    'totaalbedrag' => $totaalbedrag
]);
