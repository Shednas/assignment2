<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    // Check if job is archived
    $check = $pdo->prepare('SELECT COUNT(*) as cnt FROM job_archive WHERE id = :id');
    $check->execute(['id' => $_POST['id']]);
    $isArchived = $check->fetch()['cnt'] > 0;

    if ($isArchived) {
        $stmt = $pdo->prepare('DELETE FROM job WHERE id = :id');
        $success = $stmt->execute(['id' => $_POST['id']]);
        echo json_encode(['success' => $success]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Job must be archived before it can be deleted.']);
        exit;
    }
}

echo json_encode(['success' => false]);
exit;


