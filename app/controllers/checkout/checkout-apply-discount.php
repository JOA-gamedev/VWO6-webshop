<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $kortingcode = $input['kortingcode'] ?? '';

    if (!empty($kortingcode)) {
        $database = new Database();
        $kortingcodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingcode])->fetch();

        if ($kortingcodeData) {
            $_SESSION['kortingscode'] = $kortingcodeData;
            $percentage = $kortingcodeData['percentage'] / 100;

            // Calculate the new total amount
            $totaalbedrag = 0;
            foreach ($_SESSION['winkelwagen'] as $id => $aantal) {
                $product = $database->query('SELECT prijs FROM producten WHERE id = ?', [$id])->fetch();
                $totaalbedrag += $product['prijs'] * $aantal;
            }
            $newTotal = $totaalbedrag * (1 - $percentage);

            echo json_encode(['success' => true, 'newTotal' => number_format($newTotal, 2, ',', '.')]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ongeldige kortingcode.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Kortingcode is verplicht.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
}
