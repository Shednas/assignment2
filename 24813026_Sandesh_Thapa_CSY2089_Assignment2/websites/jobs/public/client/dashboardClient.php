<?php
require_once '../../database.php';
require '../../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

if (!isset($_SESSION['client_loggedin']) || !$_SESSION['client_loggedin']) {
    header('Location: indexClient.php');
    exit;
}

$clientId = $_SESSION['client_id'];
$stmt = $pdo->prepare('SELECT job.*, category.name AS category_name FROM job JOIN category ON job.categoryId = category.id WHERE job.clientId = :clientId');
$stmt->execute(['clientId' => $clientId]);
$jobs = $stmt->fetchAll();

$title = "Jo's Jobs - Client Dashboard";
$content = loadTemplate("../../templates/dashboardClient.html.php", [
    'jobs' => $jobs,
    'client_username' => $_SESSION['client_username']
]);
require("../../templates/layout.html.php");
