<?php

if (!class_exists('Database')) {
    require __DIR__ . '/../../../src/Database.php';
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    echo 'Unauthorized';
    exit;
}

$db = new Database();
$pdo = $db->getPdo();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM producten WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        $product = [
            'id' => 'Niet beschikbaar',
            'naam' => 'Onbekend',
            'prijs' => 'Niet beschikbaar',
            'beschrijving' => 'Niet beschikbaar'
        ];
    }
} else {
    $product = [
        'id' => 'Niet beschikbaar',
        'naam' => 'Niet beschikbaar',
        'prijs' => 'Niet beschikbaar',
        'beschrijving' => 'Niet beschikbaar'
    ];
}

view("admin/product-edit", ['product' => $product]);
