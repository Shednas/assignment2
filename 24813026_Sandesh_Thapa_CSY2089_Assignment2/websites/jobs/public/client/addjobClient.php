<?php
require '../../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

if (!isset($_SESSION['client_loggedin']) || !$_SESSION['client_loggedin']) {
    header('Location: indexClient.php');
    exit;
}

$message = '';
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('INSERT INTO job (title, description, salary, location, closingDate, categoryId, clientId)
                           VALUES (:title, :description, :salary, :location, :closingDate, :categoryId, :clientId)');
    $criteria = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'salary' => $_POST['salary'],
        'location' => $_POST['location'],
        'categoryId' => $_POST['categoryId'],
        'closingDate' => $_POST['closingDate'],
        'clientId' => $_SESSION['client_id']
    ];
    $stmt->execute($criteria);
    $message = 'Job Added';
}
$categories = $pdo->query('SELECT * FROM category')->fetchAll();

$title = "Jo's Jobs - Add Job";
$content = loadTemplate("../../templates/addjobClient.html.php", [
    'categories' => $categories,
    'message' => $message
]);
require("../../templates/layout.html.php");
