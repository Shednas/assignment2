<?php
require_once '../../database.php';
session_start();

require '../../loadTemplate.php';

$title = "Jo's Jobs - Applicants";
$content = loadTemplate("../../templates/applicants.html.php", ['pdo' => $pdo]);
require("../../templates/layout.html.php");
?>