<?php
require_once '../../database.php';
session_start();

require '../../loadTemplate.php';

$stmt = $pdo->query('SELECT * FROM job_archive');
$jobs = $stmt->fetchAll();

$title = "Jo's Jobs - Archived Jobs";
$content = loadTemplate("../../templates/jobArchive.html.php", [
    'pdo' => $pdo,
    'jobs' => $jobs
]);
require("../../templates/layout.html.php");
?>