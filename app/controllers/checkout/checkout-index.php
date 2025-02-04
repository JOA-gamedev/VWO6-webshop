<?php

// Retrieve the products from the GET request
//$producten = $_GET['producten'] ?? [];

//instead of retrieving the products from the GET request, we will retrieve the products from the session
$producten = [];
$totaal = 0;

// Check if the cart exists in the session
if (isset($_SESSION['winkelwagen'])) {
    $database = new Database();
    $winkelwagen = $_SESSION['winkelwagen'];

    // Loop through the cart items
    foreach ($winkelwagen as $id => $aantal) {
        $product = $database->query('SELECT * FROM producten WHERE id = :id', [':id' => $id])->fetch();
        $product['aantal'] = $aantal;
        $product['totaal'] = $product['prijs'] * $aantal;
        $producten[] = $product;
        $totaal += $product['totaal'];
    }
    $totaal = number_format($totaal, 2, ',', '.');
}

// Retrieve the user's profile data
$profile = [
    'naam' => user()->name ?? '',
    'straat' => user()->straat ?? '',
    'huisnummer' => user()->huisnr ?? '',
    'postcode' => user()->postcode ?? '',
    'plaats' => user()->plaats ?? '',
];

// Apply the discount if a valid kortingscode is provided
if (isset($_SESSION['kortingscode'])) {
    $percentage = $_SESSION['kortingscode']['percentage'] / 100;
    $totaal = str_replace(',', '.', $totaal); // Convert to a float-compatible format
    $totaal = floatval($totaal) * (1 - $percentage);
    $totaal = number_format($totaal, 2, ',', '.'); // Ensure 2 decimal places
}

// Pass the products, profile data, and total amount to the view
view('checkout/checkout-index', [
    'producten' => $producten,
    'profile' => $profile,
    'totaalbedrag' => $totaal
]);