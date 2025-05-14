<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

$title = "Jo's Jobs - Edit Category";
$content = loadTemplate("../../templates/editcategory.html.php", ['pdo' => $pdo]);
require("../../templates/layout.html.php");