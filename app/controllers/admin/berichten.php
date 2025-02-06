<?php

function getMessages() {
    $db = new Database();
    $messages = $db->query("
        SELECT b.id, b.klant_id, u.name as klant_naam, b.onderwerp, b.bericht, b.created_at
        FROM jel_bestelt.berichten b
        LEFT JOIN jel_bestelt.users u ON b.klant_id = u.id
        LIMIT 1000
    ")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as &$message) {
        $message['reacties'] = $db->query("
            SELECT reactie, created_at
            FROM jel_bestelt.reactie
            WHERE bericht_id = ?
            ORDER BY created_at ASC
        ", [$message['id']])->fetchAll(PDO::FETCH_ASSOC);
    }

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
