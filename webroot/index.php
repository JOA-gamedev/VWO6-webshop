<?php
session_start();
//inladen van de configuratie parameters
$config = require __DIR__ . "/../app/config.php";

//handige functies
require __DIR__ . "/../src/functions.php";

//Database class
require __DIR__ . "/../src/Database.php";

//Model classes
require __DIR__ . "/../src/Model.php";
require __DIR__ . "/../app/models/User.php";
require __DIR__ . "/../app/models/Post.php";

//Database class
require __DIR__ . "/../src/Route.php";

//csrf protection
require __DIR__ . "/../src/csrf.php";

//routes
require __DIR__ . "/../app/router.php";

// Controller en view voor contactformulier
if (isset($_GET['action']) && $_GET['action'] == 'verwerk_contact') {
    include __DIR__ . '/../app/controllers/contact_controller.php';
} else {
    include __DIR__ . '/../app/views/contact_view.php';
}

// index.php
session_start();
require 'items.php';
require 'cart.php';

$items = getItems();

if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['item_id'])) {
    $itemId = filter_var($_GET['item_id'], FILTER_VALIDATE_INT);
    if ($itemId !== false) {
        addToCart($itemId);
    } else {
        // Foutafhandeling als item_id niet geldig is
        echo "Ongeldig item ID.";
    }
}

$cartItems = getCartItems();

require 'home.php';

// Include necessary files
require_once 'products.php';

// Simple routing logic
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/' || $requestUri === '/index.php') {
    // Load the main view
    include 'views/producten.view.php';
} else {
    // Handle other routes (if necessary)
    http_response_code(404);
    echo "404 Not Found";
}