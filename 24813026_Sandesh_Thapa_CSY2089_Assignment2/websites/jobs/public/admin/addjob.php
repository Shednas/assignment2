<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO job (title, description, salary, location, closingDate, categoryId)
                               VALUES (:title, :description, :salary, :location, :closingDate, :categoryId)');
        $criteria = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'salary' => $_POST['salary'],
            'location' => $_POST['location'],
            'categoryId' => $_POST['categoryId'],
            'closingDate' => $_POST['closingDate'],
        ];
        $stmt->execute($criteria);
        $message = 'Job Added';
    } else {
        $message = '';
    }
    $title = "Jo's Jobs - Add Job";
    $content = loadTemplate("../../templates/addjob.html.php", [
        'pdo' => $pdo,
        'message' => $message ?? ''
    ]);
    require("../../templates/layout.html.php");
} else {
    header('Location: indexAdmin.php');
    exit;
}


