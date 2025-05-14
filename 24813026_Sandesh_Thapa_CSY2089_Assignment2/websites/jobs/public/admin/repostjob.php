<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
session_start();

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    // Check if already exists in job table
    $check = $pdo->prepare('SELECT COUNT(*) as cnt FROM job WHERE id = :id');
    $check->execute(['id' => $_POST['id']]);
    if ($check->fetch()['cnt'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Job already exists in jobs table.']);
        exit;
    }

    // Copy job from archive to main job table
    $stmt = $pdo->prepare('INSERT INTO job (id, title, description, salary, closingDate, categoryId, location)
                           SELECT id, title, description, salary, closingDate, categoryId, location FROM job_archive WHERE id = :id');
    $success = $stmt->execute(['id' => $_POST['id']]);

    // Do NOT delete from job_archive

    echo json_encode(['success' => $success]);
    exit;
}

echo json_encode(['success' => false]);
exit;
