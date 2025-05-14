<?php
    require_once '../database.php';
    require '../loadTemplate.php'; 

    $title = "Jo's Jobs - Home";
    $pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');

    // Fetch the 5 jobs closing soonest (with closingDate in the future)
    $stmt = $pdo->prepare('SELECT job.*, category.name as category_name FROM job JOIN category ON job.categoryId = category.id WHERE closingDate > CURDATE() ORDER BY closingDate ASC LIMIT 5');
    $stmt->execute();
    $closingSoonJobs = $stmt->fetchAll();

    $content = loadTemplate("../templates/index.html.php", [
        'pdo' => $pdo,
        'closingSoonJobs' => $closingSoonJobs
    ]);
    require("../templates/layout.html.php");
?>