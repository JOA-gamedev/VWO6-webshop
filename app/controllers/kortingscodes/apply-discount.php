<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kortingscode = $_POST['kortingscode'] ?? '';

    if (!empty($kortingscode)) {
        $database = new Database();
        $kortingscodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingscode])->fetch();

        if ($kortingscodeData) {
            $_SESSION['kortingscode'] = $kortingscodeData;
            flash('Kortingscode toegepast.');
        } else {
            flash('Ongeldige kortingscode.', 'error');
        }
    } else {
        flash('Kortingscode is verplicht.', 'error');
    }

    redirect('/checkout');
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
