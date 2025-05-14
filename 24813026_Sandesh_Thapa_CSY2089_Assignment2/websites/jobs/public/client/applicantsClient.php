<?php
require '../../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

if (!isset($_SESSION['client_loggedin']) || !$_SESSION['client_loggedin']) {
    header('Location: indexClient.php');
    exit;
}

$jobId = $_GET['jobId'] ?? null;
$clientId = $_SESSION['client_id'];

$stmt = $pdo->prepare('SELECT * FROM job WHERE id = :id AND clientId = :clientId');
$stmt->execute(['id' => $jobId, 'clientId' => $clientId]);
$job = $stmt->fetch();

if (!$job) {
    $content = "You do not have access to this job or it does not exist.";
    $title = "Applicants";
    require("../../templates/layout.html.php");
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM applicants WHERE jobId = :jobId');
$stmt->execute(['jobId' => $jobId]);
$applicants = $stmt->fetchAll();

$title = "Applicants for " . htmlspecialchars($job['title']);
$content = loadTemplate("../../templates/applicantsClient.html.php", [
    'job' => $job,
    'applicants' => $applicants
]);
require("../../templates/layout.html.php");
