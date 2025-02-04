<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kortingscode = $_POST['kortingscode'] ?? '';

    if (!empty($kortingscode)) {
        $database = new Database();
        $kortingscodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingscode])->fetch();

        if ($kortingscodeData) {
            $_SESSION['kortingscode'] = $kortingscodeData;
            $percentage = $kortingscodeData['percentage'] / 100;
            $totaal = $_SESSION['totaal'] ?? 0;
            $totaal = str_replace(',', '.', $totaal); // Convert to a float-compatible format
            $totaal = floatval($totaal) * (1 - $percentage);
            $totaal = number_format($totaal, 2, ',', '.'); // Ensure 2 decimal places
            $_SESSION['totaal'] = $totaal;
            echo json_encode(['success' => true, 'message' => 'Kortingscode toegepast.', 'totaal' => $totaal]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ongeldige kortingscode.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Kortingscode is verplicht.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>