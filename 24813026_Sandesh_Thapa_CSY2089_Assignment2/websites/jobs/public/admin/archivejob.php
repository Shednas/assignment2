<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    // Copy job to archive
    $stmt = $pdo->prepare('INSERT INTO job_archive (id, title, description, salary, closingDate, categoryId, location)
                           SELECT id, title, description, salary, closingDate, categoryId, location FROM job WHERE id = :id');
    $stmt->execute(['id' => $_POST['id']]);

    // Delete job from main table
    $stmt = $pdo->prepare('DELETE FROM job WHERE id = :id');
    $stmt->execute(['id' => $_POST['id']]);

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
exit;
