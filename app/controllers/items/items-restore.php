<?php

$db = new Database();
$db->query("UPDATE producten SET deleted_at = NULL WHERE id = :id", [
    'id' => $_POST['id']
]);
flash("Item is hersteld");
//doorsturen naar de productbeheer pagina
header("location: /admin/productbeheer");
