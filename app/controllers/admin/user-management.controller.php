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

$users = $pdo->query("SELECT * FROM `jel_bestelt`.`users` LIMIT 1000")->fetchAll(PDO::FETCH_ASSOC);

view("admin/user-management", ['users' => $users]);
?>
