<?php

//INPUT: kortingscode (GET)
//OUTPUT: totalAmount (JSON)

//moest het veranderen in een GET request omdat het anders niet werkte en we halen eigenlijk alleen data op
//ook evenveel informatie op dan dat we posten dus

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $kortingscode_in = $_GET['kortingscode'] ?? ''; // get input code

    if (!empty($kortingscode_in)) {
        $database = new Database();
        //retrieve $kortingscodeData from row at CODE
        $kortingscodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingscode_in])->fetch();

        if ($kortingscodeData) {
            
            //bereken totaalbedrag
            $originalAmount = floatval(str_replace(',', '.', $_SESSION['totaal'] ?? 0));
            
            if ($originalAmount > 0) {

                $_SESSION['kortingscode'] = $kortingscodeData; // zet kortingscode object in sessie

                $discountAmount = $originalAmount * ($kortingscodeData['percentage'] / 100);
                $totalAmount = $originalAmount - $discountAmount;

                //formatteer totaalbedrag
                $totalAmount = number_format($totalAmount, 2, ',', '.'); // Ensure 2 decimal places

                //bewaar totaal in sessie (optioneel)
                $_SESSION['nieuwTotaal'] = $totalAmount;

                //geef totaalbedrag terug in json formaat
                echo json_encode(['success' => true, 'message' => 'Kortingscode toegepast.', 'totaal' => $totalAmount]);

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