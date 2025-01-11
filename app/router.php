<?php
//ROUTER
$route = new Route();
// Hier doen we een controle of een bepaalde URL bestaat en we verwijzen door naar een controller of een view

$route->get('', "controllers/home.php");
$route->get('index', "controllers/home.php");
$route->get('contact', "controllers/contact.php");
$route->post('contact', "controllers/contact.php");
$route->get('about', "controllers/about.php");
$route->get('producten', "controllers/producten.php");
$route->get('product-detail', "controllers/product-detail.php");

$route->get('login', "views/login.view.php");
$route->post('login', "controllers/login.php");
$route->get('logout', "controllers/logout.php");

// Voeg de route voor registreren toe
$route->get('registreer-create', "controllers/registreer-create.php");
$route->post('registreer-store',"controllers/registreer-store.php");

//admin
$route->get('api/productbeheer-search', "controllers/api/productbeheer-search.php");
$route->get('productbeheer', "views/productbeheer.view.php");
$route->get('product-edit', "controllers/product-edit.php");
$route->post('product-edit', "controllers/product-edit.php");
$route->get('admin-dashboard', "views/admin-dashboard.view.php");

if (auth()) { //alleen als je ingelogd bent kan je dit doen
    $route->get('api/users-search', "controllers/api/users-search.php");
    $route->get('users', "views/users-search.view.php");
    $route->get('profiel-edit', "controllers/profiel-edit.php"); // moet naar auth() maar voor nu is het hier makkelijker
    $route->post('profiel-update', "controllers/profiel-update.php"); // Voeg de ontbrekende route toe
    $route->post('profiel-delete', "controllers/profiel-delete.php"); // Voeg de route voor profiel verwijderen toe
    $route->get('bestel-status', "controllers/bestel-status.php");
}

//alleen toegankelijk als administrator
if (hasRole('admin')) {
    //hier komen de routes die alleen toegankelijk zijn voor een admin
}

http_response_code(404);
view("404", ['error' => $_SERVER['REQUEST_URI'] . " niet gevonden"]);
die();