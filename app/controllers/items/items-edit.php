<?php
//geadapteerd van product-edit.php
//haalt item op die ID in GET matched
//ADMIN-FUNCTIE

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Geen product-ID opgegeven.");
}

$db = new Database();
$item = $db->query('SELECT * FROM producten WHERE id = ?', [$id])->fetch();

if (!$item) {
    die("Product niet gevonden.");
}

//item niet items want we kijken maar naar één item nu
view("items-edit", [
    'item' => $item,
]);