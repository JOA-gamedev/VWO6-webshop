<?php

// Database connection
$db = new Database();

// Fetch products from the database
$producten = $db->query("SELECT * FROM producten")->fetchAll(PDO::FETCH_ASSOC);

view("producten", ['producten' => $producten]); // Laad de view 'producten.view.php' en geef de variabele $producten mee