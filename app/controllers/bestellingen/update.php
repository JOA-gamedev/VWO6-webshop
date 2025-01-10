<?php
// update.php
require 'BestellingenController.php';

$controller = new BestellingenController();
$controller->update($_GET['id']);