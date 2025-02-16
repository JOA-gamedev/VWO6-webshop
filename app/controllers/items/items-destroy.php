<?php

$db = new Database();
$db->query("UPDATE producten SET deleted_at = NOW() WHERE id = :id", [
    'id' => $_POST['id']
]);
flash("Product is succesvol verwijderd");
//doorsturen naar de productbeheer pagina
header("location: /admin/productbeheer");