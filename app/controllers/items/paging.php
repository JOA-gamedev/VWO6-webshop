<?php
//initialiseren van database class
$db = new Database();

// Pagination logic
$items_per_page = 12;
$offset = ($page - 1) * $items_per_page;

$total_query = "SELECT COUNT(*) FROM producten WHERE 1=1";
$total_params = $params;
$total_items = $db->query($total_query, $total_params)->fetchColumn();

$total_pages = ceil($total_items / $items_per_page);

$query .= " LIMIT $offset, $items_per_page";

view('items/items-index', [
    'items' => $db->query($query, $params)->fetchAll(),
    'current_page' => $page,
    'max_price' => $max_price,
    'total_items' => $total_items,
    'total_pages' => $total_pages
]);
?>
