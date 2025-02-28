<?php
//initialiseren van database class
$db = new Database();

// Zoek- en filterfunctie
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_color = isset($_GET['filter_color']) ? $_GET['filter_color'] : '';
$filter_price_min = isset($_GET['filter_price_min']) ? $_GET['filter_price_min'] : '';
$filter_price_max = isset($_GET['filter_price_max']) ? $_GET['filter_price_max'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'naam_asc';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$query = "SELECT * FROM producten WHERE geslacht = 'man'";
$params = [];
if ($search) {
    $query .= " AND (naam LIKE :search OR kleur LIKE :search OR prijs LIKE :search OR beschrijving LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}
if ($filter_color) {
    $query .= " AND kleur LIKE :filter_color";
    $params[':filter_color'] = '%' . $filter_color . '%';
}
if ($filter_price_min && $filter_price_max) {
    $query .= " AND prijs BETWEEN :price_min AND :price_max";
    $params[':price_min'] = $filter_price_min;
    $params[':price_max'] = $filter_price_max;
}

// Pagination logic
$items_per_page = 12;
$offset = ($page - 1) * $items_per_page;

$total_query = "SELECT COUNT(*) FROM producten WHERE geslacht = 'man'";
$total_params = $params;
if ($search) {
    $total_query .= " AND (naam LIKE :search OR kleur LIKE :search OR prijs LIKE :search OR beschrijving LIKE :search)";
}
if ($filter_color) {
    $total_query .= " AND kleur LIKE :filter_color";
}
if ($filter_price_min && $filter_price_max) {
    $total_query .= " AND prijs BETWEEN :price_min AND :price_max";
}

$total_items = $db->query($total_query, $total_params)->fetchColumn();

$total_pages = ceil($total_items / $items_per_page);

switch ($sort) {
    case 'naam_asc':
        $query .= " ORDER BY naam ASC";
        break;
    case 'naam_desc':
        $query .= " ORDER BY naam DESC";
        break;
    case 'prijs_asc':
        $query .= " ORDER BY prijs ASC";
        break;
    case 'prijs_desc':
        $query .= " ORDER BY prijs DESC";
        break;
    case 'kleur_asc':
        $query .= " ORDER BY kleur ASC";
        break;
    case 'kleur_desc':
        $query .= " ORDER BY kleur DESC";
        break;
    default:
        $query .= " ORDER BY naam ASC";
        break;
}

$query .= " LIMIT $offset, $items_per_page";

//get max price of all items
$max_price = $db->query("SELECT MAX(prijs) as max_price FROM producten")->fetch()["max_price"];

//view met item teruggegeven
view('items/items-men', [
    'items' => $db->query($query, $params)->fetchAll(),
    'current_page' => $page,
    'max_price' => $max_price,
    'total_items' => $total_items,
    'total_pages' => $total_pages
]);
?>