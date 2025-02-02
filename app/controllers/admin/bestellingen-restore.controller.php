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

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("UPDATE bestellingen SET deleted_at = NULL, status = 'aangemaakt' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $_SESSION['flash'] = 'Bestelling succesvol hersteld.';
    header('Location: /admin/bestellingen');
    exit;
} else {
    echo 'Invalid input.';
}
?>
