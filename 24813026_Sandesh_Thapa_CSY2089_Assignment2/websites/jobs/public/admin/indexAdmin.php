<?php
require_once '../../database.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

$message = '';
if (isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM staff WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header('Location: indexAdmin.php');
        exit;
    } else {
        $message = 'Invalid username or password.';
    }
}

$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $_SESSION['username'] ?? '';

require '../../templates/indexAdmin.html.php';
