<?php
// edit.php
require 'BestellingenController.php';

$controller = new BestellingenController();
$controller->edit($_GET['id']);