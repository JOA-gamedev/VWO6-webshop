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
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$straat = filter_input(INPUT_POST, 'straat', FILTER_SANITIZE_STRING);
$huisnr = filter_input(INPUT_POST, 'huisnr', FILTER_SANITIZE_STRING);
$postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
$plaats = filter_input(INPUT_POST, 'plaats', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if ($id && $name && $email && $straat && $huisnr && $postcode && $plaats) {
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, straat = :straat, huisnr = :huisnr, postcode = :postcode, plaats = :plaats, password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, straat = :straat, huisnr = :huisnr, postcode = :postcode, plaats = :plaats WHERE id = :id");
    }
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':straat', $straat);
    $stmt->bindParam(':huisnr', $huisnr);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':plaats', $plaats);
    $stmt->execute();
    $_SESSION['flash'] = 'Gebruiker succesvol aangepast.';
    header('Location: /admin/user-management');
    exit;
} else {
    echo 'Invalid input.';
}
?>
