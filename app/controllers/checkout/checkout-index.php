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
    foreach ($winkelwagen as $key => $aantal) {
        list($id, $size) = explode('-', $key);
        $product = $database->query('SELECT * FROM producten WHERE id = :id', [':id' => $id])->fetch();
        $product['aantal'] = $aantal;
        $product['maat'] = $size;
        $product['totaal'] = $product['prijs'] * $aantal;
        $producten[] = $product;
        $totaal += $product['totaal'];
    }
    $totaal = number_format($totaal, 2, ',', '.');
    $_SESSION['totaal'] = $totaal; // Store the total amount in the session
}

// Remove the kortingscode from the session when starting the checkout process
unset($_SESSION['kortingscode']);

// Retrieve the user's profile data
$profile = [
    'naam' => user()->name ?? '',
    'straat' => user()->straat ?? '',
    'huisnummer' => user()->huisnr ?? '',
    'postcode' => user()->postcode ?? '',
    'plaats' => user()->plaats ?? '',
];

// Pass the products, profile data, and total amount to the view
view('checkout/checkout-index', [
    'producten' => $producten,
    'profile' => $profile,
    'totaalbedrag' => $totaal
]);