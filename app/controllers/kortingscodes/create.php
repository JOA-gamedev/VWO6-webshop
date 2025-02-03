<?php

require "../src/Validator.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $code = $_POST['code'] ?? '';
    $percentage = isset($_POST['percentage']) ? (int)$_POST['percentage'] : '';

    $errors = [];

    if (!Validator::required($code)) {
        $errors[] = 'Code is required.';
    }

    if (!Validator::required($percentage)) {
        $errors[] = 'Percentage is required.';
    }

    if (!Validator::integer($percentage) || !Validator::between($percentage, 0, 100)) {
        $errors[] = 'Percentage must be an integer between 0 and 100.';
    }

    if (empty($errors)) {
        $db = new Database;

        $db->query("INSERT INTO kortingcodes (code, percentage) VALUES (?, ?)", [
            $code,
            $percentage
        ]);

        header("Location: /kortingscodes");
        exit;
    } else {
        $_SESSION['errors'] = $errors;
        var_dump($errors);
        die();
        header("Location: /kortingscodes");
        exit;
    }
}