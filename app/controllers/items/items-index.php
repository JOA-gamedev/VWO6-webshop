<?php
//initialiseren van database class
$db = new Database();

// Zoekfunctie
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM producten";
$params = [];
if ($search) {
    $query .= " WHERE naam LIKE :search";
    $params['search'] = '%' . $search . '%';
}

//view met item teruggegeven
view('items/items-index', [
    'items' => $db->query($query, $params)->fetchAll()
]);