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
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $user = [
            'id' => 'Niet beschikbaar',
            'name' => 'Onbekend',
            'email' => 'Niet beschikbaar',
            'straat' => 'Niet beschikbaar',
            'huisnr' => 'Niet beschikbaar',
            'postcode' => 'Niet beschikbaar',
            'plaats' => 'Niet beschikbaar'
        ];
    }
} else {
    $user = [
        'id' => 'Niet beschikbaar',
        'name' => 'Niet beschikbaar',
        'email' => 'Niet beschikbaar',
        'straat' => 'Niet beschikbaar',
        'huisnr' => 'Niet beschikbaar',
        'postcode' => 'Niet beschikbaar',
        'plaats' => 'Niet beschikbaar'
    ];
}

view("admin/user-edit", ['user' => $user]);
?>
