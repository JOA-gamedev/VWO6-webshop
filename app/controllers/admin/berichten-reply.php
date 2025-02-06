<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['message_id'];
    $reply = $_POST['reply'];

    $db = new Database();
    $db->query("INSERT INTO jel_bestelt.reactie (bericht_id, reactie, created_at) VALUES (?, ?, NOW())", [$messageId, $reply]);

    $_SESSION['flash_message'] = "Reactie succesvol toegevoegd.";
    header("Location: /admin/berichten");
    exit;
}
