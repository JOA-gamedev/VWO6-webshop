<?php

//INPUT: kortingscode (GET)
//OUTPUT: totalAmount (JSON)

//moest het veranderen in een GET request omdat het anders niet werkte en we halen eigenlijk alleen data op
//ook evenveel informatie op dan dat we posten dus

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $kortingscode_in = $_GET['kortingscode'] ?? '';

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