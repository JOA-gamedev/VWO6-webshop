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
            // Check if the discount code has already been used
            if ($kortingscodeData['used']) {
                echo json_encode(['success' => false, 'message' => 'Deze kortingscode is al gebruikt.']);
                exit;
            }

            $_SESSION['kortingscode'] = $kortingscodeData; // zet kortingscode object in sessie

            //bereken totaalbedrag
            $originalAmount = floatval(str_replace(',', '.', $_SESSION['totaal'] ?? 0));
            if ($originalAmount > 0) {
                $discountAmount = $originalAmount * ($kortingscodeData['percentage'] / 100);
                $totalAmount = $originalAmount - $discountAmount;

                //formatteer totaalbedrag
                $totalAmount = number_format($totalAmount, 2, ',', '.'); // Ensure 2 decimal places

                //bewaar totaal in sessie (optioneel)
                $_SESSION['totaal'] = $totalAmount;

                // Mark the discount code as used
                $database->query('UPDATE kortingcodes SET used = 1 WHERE code = ?', [$kortingscode_in]);

                //geef totaalbedrag terug in json formaat
                echo json_encode(['success' => true, 'message' => 'Kortingscode toegepast.', 'totaal' => $totalAmount]);

                // Ensure the discount code is applied only once
                unset($_SESSION['kortingscode']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Ongeldig totaalbedrag.']);
            }
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