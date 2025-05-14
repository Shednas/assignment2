<?php
require_once '../../database.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

// Add staff
$message = '';
if (isset($_POST['add_staff'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'admin';
    if ($username && $password) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM staff WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() == 0) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare('INSERT INTO staff (username, password, role) VALUES (?, ?, ?)')->execute([$username, $hash, $role]);
            $message = 'Staff added.';
        } else {
            $message = 'Username already exists.';
        }
    } else {
        $message = 'Username and password required.';
    }
}

// Delete staff
if (isset($_POST['delete_staff'])) {
    $id = $_POST['id'];
    // Prevent deleting superadmin
    $stmt = $pdo->prepare('SELECT cannot_delete FROM staff WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row && !$row['cannot_delete']) {
        $pdo->prepare('DELETE FROM staff WHERE id = ?')->execute([$id]);
        $message = 'Staff deleted.';
    } else {
        $message = 'Cannot delete super admin.';
    }
}

// Fetch all staff
$staff = $pdo->query('SELECT id, username, role, cannot_delete FROM staff')->fetchAll();

$title = "Jo's Jobs - Staff Management";
$content = loadTemplate("../../templates/staffManagement.html.php", [
    'staff' => $staff,
    'message' => $message
]);
require("../../templates/layout.html.php");


