<?php
require_once '../../database.php';
require '../../controllers/categoryController.php';

$controller = new CategoryController($pdo);
$controller->add();
?>