<?php
require '../../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

$message = '';
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $company = trim($_POST['company']);

    if ($username && $password && $company) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM client WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() == 0) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare('INSERT INTO client (username, password, company) VALUES (?, ?, ?)')->execute([$username, $hash, $company]);
            $message = 'Registration successful. You can now <a href="indexClient.php">log in</a>.';
        } else {
            $message = 'Username already exists.';
        }
    } else {
        $message = 'All fields are required.';
    }
}

$title = "Jo's Jobs - Client Registration";
$content = loadTemplate("../../templates/registerClient.html.php", ['message' => $message]);
require("../../templates/layout.html.php");
