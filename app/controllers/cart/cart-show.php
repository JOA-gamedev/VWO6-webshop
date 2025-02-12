<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login-required page if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: /cart/login-required');
    exit;
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

/*
 * In de view kan je nu de producten array doorlopen en de gegevens tonen
 * De array bevat alle producten uit de winkelwagen met alle kolommen uit de database
 * verrijkt met het aantal en de totaalprijs (totaal)
 * De totaalprijs is opgemaakt met number_format en is het totaalbedrag van de winkelwagen
 *
 * Uiteraard kan je hier nog een mooie kortingscode aan toevoegen
 *
 * */
?>