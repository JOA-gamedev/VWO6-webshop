<?php
$db = new Database();

view('items-edit', [
    'item' => $db->query("SELECT * FROM items WHERE id=?", [$_GET['id']])->fetch()
]);
