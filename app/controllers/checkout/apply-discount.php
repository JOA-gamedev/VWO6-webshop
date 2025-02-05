<?php

//INPUT: kortingscode (POST)
//OUTPUT: tot

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kortingscode_in = $_POST['kortingscode'] ?? '';

    if (!empty($kortingscode_in)) {
        $database = new Database();
        $kortingscodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingscode_in])->fetch();

        if ($kortingscodeData) {
            $_SESSION['kortingscode'] = $kortingscodeData; // zet kortingscode object in sessie

            //bereken totaalbedrag
            $originalAmount = $_SESSION['order']['totaalbedrag'];
            $discountAmount = $originalAmount * ($kortingscodeData['percentage'] / 100);
            $totalAmount = $originalAmount - $discountAmount;

            //formatteer totaalbedrag
            $totalAmount = floatval(str_replace(',', '.', $totalAmount)); // Ensure it's a float
            $totalAmount = number_format($totalAmount, 2, ',', '.'); // Ensure 2 decimal places

            //bewaar totaal in sessie (optioneel)
            $_SESSION['totaal'] = $totalAmount;

            //geef totaalbedrag terug in json formaat
            echo json_encode(['success' => true, 'message' => 'Kortingscode toegepast.', 'totaal' => $totalAmount]);
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