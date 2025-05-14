<?php
    require '../loadTemplate.php'; 

    $title = "Jo's Jobs - Career Advice";
	$content = loadTemplate("../templates/careerAdvice.html.php", []);
    require("../templates/layout.html.php");
?>