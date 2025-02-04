<?php
require_once __DIR__ . '/../../config.php'; // Correct path to config.php

session_start();

$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = number_format((float)$_POST['prijs'], 2, '.', ''); // Ensure price is formatted to two decimal places
    $type_id = 1; // Always set type_id to 1
    $afbeelding = $_FILES['afbeelding']['name'];
    $afbeelding_naam = $_POST['afbeelding_naam'];

    // Validate the afbeelding_naam field
    if (empty($afbeelding_naam)) {
        $_SESSION['flash'] = "Afbeeldingnaam is verplicht!";
        header("Location: /admin/product-add");
        exit;
    }

    // Use the provided filename
    $afbeelding = $afbeelding_naam . '.' . pathinfo($afbeelding, PATHINFO_EXTENSION);

    // Sanitize the file name
    $afbeelding = preg_replace('/\.(?=.*\.)/', '', $afbeelding);
    $target_dir = __DIR__ . "/../../../uploads/";
    $target_file = $target_dir . basename($afbeelding);

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], $target_file)) {
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        // Insert product into the database
        $sql = "INSERT INTO `producten` (`naam`, `beschrijving`, `prijs`, `type_id`, `afbeelding`, `created_at`, `updated_at`) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [$naam, $beschrijving, $prijs, $type_id, $afbeelding, $created_at, $updated_at];

        if ($db->query($sql, $params)) {
            $_SESSION['flash'] = "Product successfully added!";
            header("Location: /admin/product-add");
            exit;
        } else {
            echo "Failed to add product.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
