<?php
require '../loadTemplate.php';

$title = "About Jo's Jobs";
$content = loadTemplate("../templates/about.html.php", []);
require("../templates/layout.html.php");
?>