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
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        $order = [
            'id' => 'Niet beschikbaar',
            'naam' => 'Onbekend',
            'producten' => 'Niet beschikbaar',
            'totaalprijs' => 'Niet beschikbaar',
            'status' => 'Niet beschikbaar'
        ];
    }
} else {
    $order = [
        'id' => 'Niet beschikbaar',
        'naam' => 'Niet beschikbaar',
        'producten' => 'Niet beschikbaar',
        'totaalprijs' => 'Niet beschikbaar',
        'status' => 'Niet beschikbaar'
    ];
}

view("admin/orders-edit", ['order' => $order]);
?>
