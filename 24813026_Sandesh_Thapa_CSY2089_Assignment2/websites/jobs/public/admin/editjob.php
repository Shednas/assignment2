<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

$title = "Jo's Jobs - Edit Job";
$content = loadTemplate("../../templates/editjob.html.php", ['pdo' => $pdo]);
require("../../templates/layout.html.php");