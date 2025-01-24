<?php
//initialiseren van database class
$db = new Database();

//view met item teruggegeven
view('items/items-index', [
    'items' => $db->query("SELECT * FROM producten")->fetchAll()
]);