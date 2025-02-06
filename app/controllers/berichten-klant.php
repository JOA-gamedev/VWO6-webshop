<?php

function getCustomerMessages() {
    $db = new Database();
    $customerId = $_SESSION['user']['id'];
    $messages = $db->query("SELECT id, klant_id, onderwerp, bericht, created_at, updated_at FROM jel_bestelt.berichten WHERE klant_id = ? LIMIT 1000", [$customerId])->fetchAll(PDO::FETCH_ASSOC);
    return $messages;
}

$messages = getCustomerMessages();
foreach ($messages as &$message) {
    if (is_null($message['klant_id'])) {
        $message['klant_id'] = 'Anonieme gebruiker';
    }
}
require __DIR__ . '/../views/berichten-klant.view.php';
