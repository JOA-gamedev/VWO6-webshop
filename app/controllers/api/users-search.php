<?php
//gebruik van database object
$db = new Database();

//users opzoeken die aan onze zoek query voldoen en deze in $users zetten
$users = $db->query(
    "SELECT id, name, role, email, plaats
           FROM users 
           WHERE name LIKE ? OR email LIKE ? OR role LIKE ? OR plaats LIKE ?
          LIMIT 10", [
      "%" . $_GET['search'] . "%", 
      "%" . $_GET['search'] . "%", 
      "%" . $_GET['search'] . "%", 
      "%" . $_GET['search'] . "%",   //zoeken naar alles wat er op lijkt
    ]
)->fetchAll();

// het resultaat geven we terug in json formaat
echo json_encode($users);