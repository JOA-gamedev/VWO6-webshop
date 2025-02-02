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
    $klant_id = filter_input(INPUT_POST, 'klant_id', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $product_ids = explode(',', filter_input(INPUT_POST, 'product_ids', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $prijzen = explode(',', filter_input(INPUT_POST, 'prijzen', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if ($id && $klant_id && $status && !empty($product_ids) && !empty($prijzen) && count($product_ids) === count($prijzen)) {
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE bestellingen SET klant_id = :klant_id, status = :status WHERE id = :id");
            $stmt->bindParam(':klant_id', $klant_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $pdo->prepare("DELETE FROM `jel_bestelt`.`bestelregels` WHERE bestelling_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $pdo->prepare("INSERT INTO `jel_bestelt`.`bestelregels` (bestelling_id, product_id, prijs) VALUES (:bestelling_id, :product_id, :prijs)");
            foreach ($product_ids as $index => $product_id) {
                $stmt->bindParam(':bestelling_id', $id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':prijs', $prijzen[$index]);
                $stmt->execute();
            }

            $pdo->commit();
            header('Location: /admin/bestellingen');
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo 'Database error: ' . $e->getMessage();
        }
    } else {
        echo 'Invalid input.';
    }
}
?>
