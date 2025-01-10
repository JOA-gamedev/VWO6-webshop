<?php
// delete.php
require 'BestellingenController.php';

$controller = new BestellingenController();
$controller->delete($_GET['id']);