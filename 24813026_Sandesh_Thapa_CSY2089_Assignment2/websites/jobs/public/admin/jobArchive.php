<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

$title = "Jo's Jobs - Archived Jobs";
$content = loadTemplate("../../templates/jobArchieve.html.php", ['pdo' => $pdo]);
require("../../templates/layout.html.php");
?>