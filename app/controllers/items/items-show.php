<?php
//initialiseren van database class
$db = new Database();

//view met item teruggegeven
view('items/items-show', [
    'item' => $db->query("SELECT * FROM producten WHERE id=?", [$_GET['id']])->fetch(),
    'gender' => $db->query("SELECT gender FROM producten WHERE id=?", [$_GET['id']])->fetchColumn()
]);