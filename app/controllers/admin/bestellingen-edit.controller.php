<?php
session_start();
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
    $stmt = $pdo->prepare("SELECT * FROM bestellingen WHERE id = ?");
    $stmt->execute([$id]);
    $bestelling = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($bestelling) {
        $stmt = $pdo->prepare("SELECT product_id FROM `jel_bestelt`.`bestelregels` WHERE bestelling_id = ? LIMIT 1000");
        $stmt->execute([$id]);
        $product_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $bestelling['product_ids'] = $product_ids;
    } else {
        $bestelling = [
            'id' => 'Niet beschikbaar',
            'klant_id' => 'Onbekend',
            'producten' => 'Niet beschikbaar',
            'totaalprijs' => 'Niet beschikbaar',
            'status' => 'Niet beschikbaar',
            'product_ids' => []
        ];
    }
} else {
    $bestelling = [
        'id' => 'Niet beschikbaar',
        'klant_id' => 'Niet beschikbaar',
        'producten' => 'Niet beschikbaar',
        'totaalprijs' => 'Niet beschikbaar',
        'status' => 'Niet beschikbaar',
        'product_ids' => []
    ];
}

view("admin/bestellingen-edit", ['bestelling' => $bestelling]);
?>
