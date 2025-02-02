<?php

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $percentage = $_POST['percentage'];

    $query = "UPDATE kortingcodes SET code = :code, percentage = :percentage WHERE id = :id";
    $params = [
        ':id' => $id,
        ':code' => $code,
        ':percentage' => $percentage
    ];

    $db->query($query, $params);
}

header('Location: /kortingscodes');
exit;
?>