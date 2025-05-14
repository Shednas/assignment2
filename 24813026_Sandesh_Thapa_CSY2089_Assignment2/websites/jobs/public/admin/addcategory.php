<?php
require '../../database.php';
require '../../functions.php';
require '../../controllers/categoryController.php';

$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
$controller = new CategoryController($pdo);
$controller->addCategory();
?>