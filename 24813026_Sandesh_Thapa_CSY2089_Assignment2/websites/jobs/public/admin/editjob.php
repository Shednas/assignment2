<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../database.php';
require '../../controllers/JobController.php';

$controller = new JobController($pdo);
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$controller->edit($id);
