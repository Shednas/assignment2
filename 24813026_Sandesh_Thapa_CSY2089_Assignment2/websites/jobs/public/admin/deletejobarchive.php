<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    // Only deletes from job_archive table when delete is clicked
    $stmt = $pdo->prepare('DELETE FROM job_archive WHERE id = :id');
    $success = $stmt->execute(['id' => $_POST['id']]);
    echo json_encode(['success' => $success]);
    exit;
}

echo json_encode(['success' => false]);
exit;
