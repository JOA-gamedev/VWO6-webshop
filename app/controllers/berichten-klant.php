<?php

function getCustomerMessages() {
    $db = new Database();
    $customerId = $_SESSION['user']['id'];
    $messages = $db->query("
        SELECT b.id, b.klant_id, b.onderwerp, b.bericht, b.created_at
        FROM jel_bestelt.berichten b
        WHERE b.klant_id = ?
        LIMIT 1000
    ", [$customerId])->fetchAll(PDO::FETCH_ASSOC);

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

$messages = getCustomerMessages();
foreach ($messages as &$message) {
    if (is_null($message['klant_id'])) {
        $message['klant_id'] = 'Anonieme gebruiker';
    }
}
require __DIR__ . '/../views/berichten-klant.view.php';
