<?php
session_start();
require __DIR__ . '/../../src/Database.php';
require __DIR__ . '/../../src/csrf.php'; // Include CSRF functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        http_response_code(403);
        echo 'CSRF token mismatch.';
        exit;
    }

    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
    $beschrijving = filter_input(INPUT_POST, 'beschrijving', FILTER_SANITIZE_STRING);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_VALIDATE_FLOAT);
    $afbeelding = filter_input(INPUT_POST, 'afbeelding', FILTER_VALIDATE_URL);

    if ($naam && $beschrijving && $prijs && $afbeelding) {
        try {
            $db = new Database();
            $pdo = $db->getPdo(); // Ensure we get the PDO connection
            $stmt = $pdo->prepare("INSERT INTO producten (naam, beschrijving, prijs, afbeelding) VALUES (:naam, :beschrijving, :prijs, :afbeelding)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':prijs', $prijs);
            $stmt->bindParam(':afbeelding', $afbeelding);
            $stmt->execute();
            header('Location: /VWO6-webshop/app/views/producten.view.php');
            exit;
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    } else {
        echo 'Invalid input.';
    }
} else {
    http_response_code(401);
    echo 'Unauthorized';
}