<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Geen product-ID opgegeven.");
}

$db = new Database();
$item = $db->query('SELECT * FROM producten WHERE id = ?', [$id])->fetch();

if (!$item) {
    die("Product niet gevonden.");
}

view("prod-img-edit", [
    'img' => $item,
]);