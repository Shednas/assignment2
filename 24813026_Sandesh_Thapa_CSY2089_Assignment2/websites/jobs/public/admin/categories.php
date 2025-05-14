<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../database.php';
require_once '../../controllers/categoryController.php';

$controller = new CategoryController($pdo);
$controller->list();
?>