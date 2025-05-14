<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

require '../../loadTemplate.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: indexAdmin.php');
    exit;
}

$message = '';
// Respond to enquiry
if (isset($_POST['respond'])) {
    // Get staff id from username
    $staffStmt = $pdo->prepare('SELECT id FROM staff WHERE username = :username');
    $staffStmt->execute(['username' => $_SESSION['username']]);
    $staff = $staffStmt->fetch();
    $staff_id = $staff ? $staff['id'] : null;

    $stmt = $pdo->prepare('UPDATE enquiries SET response = :response, status = "Complete", staff_id = :staff_id, responded_at = NOW() WHERE id = :id');
    $stmt->execute([
        'response' => $_POST['response'],
        'staff_id' => $staff_id,
        'id' => $_POST['id']
    ]);
    $message = 'Enquiry marked as complete.';
}

// Fetch all enquiries (latest first)
$enquiries = $pdo->query('SELECT e.*, s.username as staff_username FROM enquiries e LEFT JOIN staff s ON e.staff_id = s.id ORDER BY e.status ASC, e.id DESC')->fetchAll();

$title = "Jo's Jobs - Enquiries";
$content = loadTemplate("../../templates/enquiries.html.php", [
    'enquiries' => $enquiries,
    'message' => $message
]);
require("../../templates/layout.html.php");
