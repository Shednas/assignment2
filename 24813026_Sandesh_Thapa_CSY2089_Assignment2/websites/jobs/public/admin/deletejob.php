<?php
require_once '../../database.php';
require '../../controllers/JobController.php';

$controller = new JobController($pdo);
$id = $_POST['id'] ?? null;
$controller->delete($id);
