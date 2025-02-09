<?php
$db = new Database();
$items = $db->query("SELECT * FROM producten WHERE deleted_at IS NULL LIMIT 6")->fetchAll();

view("home", ['items' => $items]);