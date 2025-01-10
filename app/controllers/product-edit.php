<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission (e.g., update the database)

    //todo: data in database zetten


    flash("Wijzigingen Opgeslagen" . $user['name'], true);
    header("Location: /");
} else {
    // Handle GET request (e.g., fetch the product details)
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("Geen product-ID opgegeven.");
    }

    $db = new Database();
    $product = $db->query('SELECT * FROM producten WHERE id = ?', [$id])->fetch();

    if (!$product) {
        die("Product niet gevonden.");
    }

    view("product-edit", [
        'product' => $product,
    ]);
}
