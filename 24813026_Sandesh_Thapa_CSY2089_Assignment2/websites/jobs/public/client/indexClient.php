<?php
require_once '../../database.php';
require '../../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

$message = '';
if (isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM client WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['client_loggedin'] = true;
        $_SESSION['client_id'] = $user['id'];
        $_SESSION['client_username'] = $username;
        header('Location: dashboardClient.php');
        exit;
    } else {
        $message = 'Invalid username or password.';
    }
}

$title = "Jo's Jobs - Client Login";
$content = loadTemplate("../../templates/indexClient.html.php", ['message' => $message]);
require("../../templates/layout.html.php");

