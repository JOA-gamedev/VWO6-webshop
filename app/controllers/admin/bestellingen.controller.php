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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $bestellingen = $pdo->query("SELECT * FROM bestellingen")->fetchAll(PDO::FETCH_ASSOC);
    if ($bestellingen) {
        foreach ($bestellingen as &$bestelling) {
            $stmt = $pdo->prepare("SELECT product_id, prijs FROM `jel_bestelt`.`bestelregels` WHERE bestelling_id = ? LIMIT 1000");
            $stmt->execute([$bestelling['id']]);
            $bestelregels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $product_ids = array_column($bestelregels, 'product_id');
            $prijzen = array_column($bestelregels, 'prijs');
            $bestelling['product_ids'] = $product_ids;
            $bestelling['prijzen'] = $prijzen;
        }
    } else {
        $bestellingen = [];
    }
    view("admin/bestellingen", ['bestellingen' => $bestellingen]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    if ($id && $status) {
        $stmt = $pdo->prepare("UPDATE bestellingen SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: /admin/bestellingen');
        exit;
    } else {
        echo 'Invalid input.';
    }
}
?>
