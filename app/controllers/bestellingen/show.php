<?php
// show.php
require 'BestellingenController.php';

$controller = new BestellingenController();
$controller->show($_GET['id']);