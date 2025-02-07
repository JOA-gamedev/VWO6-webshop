<?php
//initialiseren van database class
$db = new Database();

// Zoek- en filterfunctie
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_color = isset($_GET['filter_color']) ? $_GET['filter_color'] : '';
$filter_price = isset($_GET['filter_price']) ? $_GET['filter_price'] : '';
$filter_gender = isset($_GET['filter_gender']) ? $_GET['filter_gender'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'naam_asc';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 12;
$offset = ($page - 1) * $items_per_page;

$query = "SELECT * FROM producten WHERE 1=1";
$params = [];
if ($search) {
    $query .= " AND (naam LIKE :search OR kleur LIKE :search OR prijs LIKE :search OR geslacht LIKE :search OR beschrijving LIKE :search)";
    $params['search'] = '%' . $search . '%';
}
if ($filter_color) {
    $query .= " AND kleur LIKE :filter_color";
    $params['filter_color'] = '%' . $filter_color . '%';
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
    $allowed_genders = ['male', 'female', 'unisex'];
    if (in_array($filter_gender, $allowed_genders)) {
        $query .= " AND geslacht = :filter_gender";
        $params['filter_gender'] = $filter_gender;
    }
}

$total_query = "SELECT COUNT(*) FROM producten WHERE 1=1";
$total_params = $params;
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
    case 'geslacht_asc':
        $query .= " ORDER BY geslacht ASC";
        break;
    case 'geslacht_desc':
        $query .= " ORDER BY geslacht DESC";
        break;
    default:
        $query .= " ORDER BY naam ASC";
        break;
}

$query .= " LIMIT $offset, $items_per_page";

//view met item teruggegeven
view('items/items-index', [
    'items' => $db->query($query, $params)->fetchAll(),
    'current_page' => $page,
    'total_items' => $total_items,
    'total_pages' => $total_pages
]);
?>