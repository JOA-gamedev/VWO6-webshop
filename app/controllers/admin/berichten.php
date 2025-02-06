<?php

function getMessages() {
    $db = new Database();
    $messages = $db->query("SELECT id, klant_id, onderwerp, bericht, created_at, updated_at FROM jel_bestelt.berichten")->fetchAll(PDO::FETCH_ASSOC);
    return $messages;
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

if (!isAdmin()) {
    header('Location: /login');
    exit();
}

$messages = getMessages();
foreach ($messages as &$message) {
    if (is_null($message['klant_id'])) {
        $message['klant_id'] = 'Anonieme gebruiker';
    }
}
require __DIR__ . '/../../views/admin/berichten.view.php';
