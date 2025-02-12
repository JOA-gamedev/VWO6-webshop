<?php
//ROUTER
$route = new Route();
// Hier doen we een controle of een bepaalde URL bestaat en we verwijzen door naar een controller of een view

$route->get('ui', "views/ui.view.php");

$route->get('', "controllers/home.php");
$route->get('index', "controllers/home.php");
$route->get('contact', "controllers/contact.php");
$route->post('contact', "controllers/contact.php");
$route->get('about', "controllers/about.php");
$route->get('items/items-show', "controllers/items/items-show.php");
$route->get('items/items-show/{id}', "controllers/items/items-show.php");
$route->get('items/items-index', "controllers/items/items-index.php");
$route->get('items/product-detail', "controllers/items/product-detail.php");
$route->get('items/paging', "controllers/items/paging.php");

$route->get('login', "views/login.view.php");
$route->post('login', "controllers/login.php");
$route->get('logout', "controllers/logout.php");

// Voeg de route voor registreren toe
$route->get('registreer-create', "controllers/registreer-create.php");
$route->post('registreer-store', "controllers/registreer-store.php");

// Add the route for the registration page
$route->get('registreer', "views/registreer.view.php");

$route->get('cart', "controllers/cart/cart-show.php");
$route->post('cart/add', "controllers/cart/cart-add.php");
$route->post('cart/remove', "controllers/cart/cart-remove.php");
$route->post('cart/bestel', "controllers/cart/cart-bestel.php");
$route->post('cart/update', "controllers/cart/cart-update.php");

// Add routes for cart login requirement
$route->get('cart/login-required', "controllers/cart/cart-login-required.php");

// Add routes for checkout login requirement
$route->get('checkout/login-required', "controllers/checkout/login-required.php");

// Add routes for checkout process
$route->get('checkout', "controllers/checkout/checkout-index.php");
$route->post('checkout/process', "controllers/checkout/checkout-process.php");
$route->get('checkout/apply-discount', "controllers/checkout/apply-discount.php");
$route->get('checkout/confirm', "controllers/checkout/checkout-confirm.php");
$route->post('checkout/complete', "controllers/checkout/checkout-complete.php");

if (auth()) { //alleen als je ingelogd bent kan je dit doen
    $route->get('api/users-search', "controllers/api/users-search.php");
    $route->get('users', "views/users-search.view.php");
    $route->get('profiel-edit', "controllers/profiel-edit.php"); // moet naar auth() maar voor nu is het hier makkelijker
    $route->post('profiel-update', "controllers/profiel-update.php"); // Voeg de ontbrekende route toe
    $route->post('profiel-delete', "controllers/profiel-delete.php"); // Voeg de route voor profiel verwijderen toe
    $route->get('wachtwoord-aanpassen', "views/wachtwoord-aanpassen.view.php");
    $route->post('wachtwoord-aanpassen', "controllers/wachtwoord-aanpassen.php");
    $route->get('bestel-status', "controllers/bestel-status.php");
    $route->get('bestellingen', "controllers/besteld-index.php");
    $route->get('bestellingen/{id}', "controllers/besteld-show.php");
    $route->get('berichten-klant', "controllers/berichten-klant.php");
}

//alleen toegankelijk als administrator
if (hasRole('admin')) {
    //hier komen de routes die alleen toegankelijk zijn voor een admin
    
    //gebruikers aanpassen als admin
    $route->get('user-management', "controllers/admin/user-management.controller.php");
    $route->post('user-management/update', "controllers/admin/user-update.php");
    $route->get('admin/user-edit', "controllers/admin/user-edit.controller.php");
    $route->post('admin/user-delete', "controllers/admin/user-delete.controller.php");

    $route->get('admin-dashboard', "views/admin-dashboard.view.php");

    $route->get('api/productbeheer-search', "controllers/api/productbeheer-search.php");
    $route->get('productbeheer', "views/productbeheer.view.php");

    //ADMIN-only "items" bestanden
    $route->get('items/items-edit', "controllers/items/items-edit.php");
    $route->post('items/items-update', "controllers/items/items-update.php");
    
    //prod
    $route->get('prod-img-edit', "controllers/images/prod-img-edit.php");
    $route->post('prod-img-update', "controllers/images/prod-img-update.php");

    // Bestellingen management routes
    $route->get('admin/bestellingen', "controllers/admin/bestellingen.controller.php");
    $route->post('admin/bestellingen', "controllers/admin/bestellingen.controller.php");
    $route->get('admin/bestellingen-edit', "controllers/admin/bestellingen-edit.controller.php");
    $route->post('admin/user-update', "controllers/admin/user-update.php");
    $route->get('admin/user-management', "controllers/admin/user-management.controller.php");
    $route->post('admin/user-restore', "controllers/admin/user-restore.controller.php");
    $route->post('admin/bestellingen-delete', "controllers/admin/bestellingen-delete.controller.php");
    $route->post('admin/bestellingen-restore', "controllers/admin/bestellingen-restore.controller.php");

    //kortingscodes routes
    $route->get('kortingscodes', "controllers/kortingscodes/index.php");
    $route->post('kortingscodes/update', "controllers/kortingscodes/update.php");
    $route->post('kortingscodes/create', "controllers/kortingscodes/create.php");
    $route->post('kortingscodes/delete', "controllers/kortingscodes/delete.php");

    // Product toevoegen routes
    $route->get('admin/product-add', "views/admin/product-add.view.php");
    $route->post('admin/product-add', "controllers/admin/product-add.php");

    $route->get('admin/berichten', "controllers/admin/berichten.php");
    $route->post('admin/berichten-reply', "controllers/admin/berichten-reply.php");
}

http_response_code(404);
view("404", ['error' => $_SERVER['REQUEST_URI'] . " niet gevonden"]);
die();