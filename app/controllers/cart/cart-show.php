<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize the products array and total price
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
}

// Pass the products and total price to the view
view('winkelwagen-show', [
    'producten' => $producten,
    'totaal' => $totaal
]);
?>