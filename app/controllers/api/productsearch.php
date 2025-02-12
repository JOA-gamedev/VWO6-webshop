<?php
//gebruik van database object
$db = new Database();

//users opzoeken die aan onze zoek query voldoen en deze in $users zetten
$products = $db->query(
    "SELECT *
           FROM producten 
           WHERE naam LIKE ?
          LIMIT 10", [
      "%" . $_GET['name'] . "%"  //zoeken naar alles wat er op lijkt
    ] //we hebben twee plekken waar we $name in moeten vullen
)->fetchAll();

// het resultaat geven we terug in json formaat
echo json_encode($products);