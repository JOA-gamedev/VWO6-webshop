<?php
//gebruik van database object
$db = new Database();

//users opzoeken die aan onze zoek query voldoen en deze in $users zetten
$users = $db->query(
    "SELECT id, name, email 
           FROM producten 
           WHERE name LIKE ?
          LIMIT 10", [
    "%" . $_GET['name'] . "%"  //zoeken naar alles wat er op lijkt
] //we hebben twee plekken waar we $name in moeten vullen
)->fetchAll();

//Uiteraard zou je ook Model User kunnen gebruiken (doet precies hetzelfde)
//$users = (new User)->where('name', 'LIKE', "%" . $_GET['name'] . "%")->limit(10)->get();

// het resultaat geven we terug in json formaat
echo json_encode($users);