<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $db = new Database;
        $db->query("DELETE FROM kortingcodes WHERE id = ?", [$id]);
        header("Location: /kortingscodes");
        exit;
    } else {
        // Handle the case where 'id' is not provided
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}

