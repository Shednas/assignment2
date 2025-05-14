<?php
require_once '../../database.php';
require_once '../../functions.php';
require_once '../../controllers/categoryController.php';

$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
$controller = new CategoryController($pdo);
$controller->listCategories();
?>