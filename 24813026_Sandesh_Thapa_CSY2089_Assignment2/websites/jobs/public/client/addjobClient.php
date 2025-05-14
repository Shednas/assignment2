<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../database.php';
require '../../controllers/ClientController.php';
session_start();

$controller = new ClientController($pdo);
$clientId = $_SESSION['client_id'] ?? null;
if ($clientId) {
    $controller->addJob($clientId);
} else {
    header('Location: indexClient.php');
    exit;
}
