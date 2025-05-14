<?php
require_once '../../database.php';
require '../../controllers/ClientController.php';
session_start();

$controller = new ClientController($pdo);

$action = $_GET['action'] ?? null;

if (!isset($_SESSION['client_loggedin']) || !$_SESSION['client_loggedin']) {
    header('Location: indexClient.php');
    exit;
}

$clientId = $_SESSION['client_id'];
$clientUsername = $_SESSION['client_username'];

switch ($action) {
    case 'addJob':
        $controller->addJob($clientId);
        break;
    case 'editJob':
        $jobId = $_GET['id'] ?? null;
        $controller->editJob($clientId, $jobId);
        break;
    case 'deleteJob':
        $jobId = $_POST['id'] ?? null;
        $controller->deleteJob($clientId, $jobId);
        break;
    default:
        $controller->dashboard($clientId, $clientUsername);
        break;
}
