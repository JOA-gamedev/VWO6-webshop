<?php
//initialiseren van database class
$db = new Database();

// Zoek- en filterfunctie
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_color = isset($_GET['filter_color']) ? $_GET['filter_color'] : '';
$filter_price = isset($_GET['filter_price']) ? $_GET['filter_price'] : '';
$filter_gender = isset($_GET['filter_gender']) ? $_GET['filter_gender'] : '';

$query = "SELECT * FROM producten WHERE 1=1";
$params = [];
if ($search) {
    $query .= " AND (naam LIKE :search OR kleur LIKE :search OR prijs LIKE :search OR geslacht LIKE :search OR beschrijving LIKE :search)";
    $params['search'] = '%' . $search . '%';
}
if ($filter_color) {
    $query .= " AND kleur = :filter_color";
    $params['filter_color'] = $filter_color;
}
if ($filter_price) {
    $price_range = explode('-', $filter_price);
    if (count($price_range) == 2) {
        $query .= " AND prijs BETWEEN :price_min AND :price_max";
        $params['price_min'] = $price_range[0];
        $params['price_max'] = $price_range[1];
    }
}
if ($filter_gender) {
    $query .= " AND geslacht = :filter_gender";
    $params['filter_gender'] = $filter_gender;
}

//view met item teruggegeven
view('items/items-index', [
    'items' => $db->query($query, $params)->fetchAll()
]);