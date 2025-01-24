<?php

$db = new Database();
$db->query("DELETE FROM items WHERE id = :id", [
    'id' => $_POST['id']
]);
flash("Item is verwijderd");
//doorsturen naar de index pagina
header("location: /items");