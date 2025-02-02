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
    $stmt = $pdo->prepare("SELECT * FROM bestellingen WHERE id = ?");
    $stmt->execute([$id]);
    $bestelling = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($bestelling) {
        $stmt = $pdo->prepare("SELECT product_id, prijs FROM `jel_bestelt`.`bestelregels` WHERE bestelling_id = ? LIMIT 1000");
        $stmt->execute([$id]);
        $bestelregels = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $product_ids = array_column($bestelregels, 'product_id');
        $prijzen = array_column($bestelregels, 'prijs');
        $bestelling['product_ids'] = $product_ids;
        $bestelling['prijzen'] = $prijzen;
    } else {
        $bestelling = [
            'id' => 'Niet beschikbaar',
            'klant_id' => 'Onbekend',
            'producten' => 'Niet beschikbaar',
            'totaalprijs' => 'Niet beschikbaar',
            'status' => 'Niet beschikbaar',
            'product_ids' => [],
            'prijzen' => []
        ];
    }
} else {
    $bestelling = [
        'id' => 'Niet beschikbaar',
        'klant_id' => 'Niet beschikbaar',
        'producten' => 'Niet beschikbaar',
        'totaalprijs' => 'Niet beschikbaar',
        'status' => 'Niet beschikbaar',
        'product_ids' => [],
        'prijzen' => []
    ];
}

view("admin/bestellingen-edit", ['bestelling' => $bestelling]);
?>
