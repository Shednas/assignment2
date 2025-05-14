<?php
require_once '../../database.php';
require '../../controllers/categoryController.php';

$controller = new CategoryController($pdo);
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$controller->edit($id);
