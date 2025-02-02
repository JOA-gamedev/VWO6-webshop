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
    $orders = $pdo->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_ASSOC);
    if (!$orders) {
        $orders = [];
    }
    view("admin/orders", ['orders' => $orders]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    if ($id && $status) {
        $stmt = $pdo->prepare("UPDATE orders SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: /admin/orders');
        exit;
    } else {
        echo 'Invalid input.';
    }
}
?>
