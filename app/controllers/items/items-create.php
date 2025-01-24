<?php
/*
Indien je selectboxen hebt moet je hier waarschijnlijk gegevens
 uit de database ophalen om mee te geven aan de view.
bv:
$db = new Database();
view('items-create',[
    'categories' => $db->query("SELECT * FROM categories")->fetchAll()
]);

*/
view('items-create');