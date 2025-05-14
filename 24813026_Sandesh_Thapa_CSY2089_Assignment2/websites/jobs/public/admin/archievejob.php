<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    // Check if already archived
    $check = $pdo->prepare('SELECT COUNT(*) as cnt FROM job_archive WHERE id = :id');
    $check->execute(['id' => $_POST['id']]);
    if ($check->fetch()['cnt'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Job is already archived.']);
        exit;
    }

    // Copy job to archive (do NOT delete from job table)
    $stmt = $pdo->prepare('INSERT INTO job_archive (id, title, description, salary, closingDate, categoryId, location)
                           SELECT id, title, description, salary, closingDate, categoryId, location FROM job WHERE id = :id');
    $success = $stmt->execute(['id' => $_POST['id']]);

    echo json_encode(['success' => $success]);
    exit;
}

echo json_encode(['success' => false]);
exit;