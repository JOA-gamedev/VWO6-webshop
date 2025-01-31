<?php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Retrieve the kortingscode from the form
    $kortingscode = $_POST['kortingscode'] ?? '';

    // Validate the kortingscode
    $database = new Database();
    $kortingscodeData = $database->query('SELECT * FROM kortingscodes WHERE code = ?', [$kortingscode])->fetch();

    if ($kortingscodeData) {
        // Store the kortingscode in the session
        $_SESSION['kortingscode'] = $kortingscodeData;
        flash('Kortingscode toegepast: ' . $kortingscode);
    } else {
        flash('Ongeldige kortingscode', false);
    }

    // Redirect back to the checkout page
    redirect('/checkout');
} else {
    // If the request is not a POST request, redirect to the home page
    redirect('/');
}
