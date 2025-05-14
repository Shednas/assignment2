<?php
require_once '../database.php';
require_once '../loadTemplate.php';

$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get filters
$titleFilter = isset($_GET['title']) ? trim($_GET['title']) : '';
$locationFilter = isset($_GET['location']) ? trim($_GET['location']) : '';

$where = [];
$params = ['date' => date('Y-m-d')];

if (isset($_GET['id'])) {
    $where[] = 'categoryId = :id';
    $params['id'] = $_GET['id'];
}
$where[] = 'closingDate > :date';

if ($titleFilter !== '') {
    $where[] = 'job.title LIKE :title';
    $params['title'] = '%' . $titleFilter . '%';
}
if ($locationFilter !== '') {
    $where[] = 'job.location LIKE :location';
    $params['location'] = '%' . $locationFilter . '%';
}

// Do NOT add any filter like "AND clientId IS NULL" here
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$stmt = $pdo->prepare('SELECT job.*, category.name as category_name 
                      FROM job 
                      JOIN category ON job.categoryId = category.id 
                      ' . $whereSql . '
                      ORDER BY closingDate ASC');
$stmt->execute($params);
$jobs = $stmt->fetchAll();

if (isset($_GET['id'])) {
    $categoryStmt = $pdo->prepare('SELECT name FROM category WHERE id = :id');
    $categoryStmt->execute(['id' => $_GET['id']]);
    $category = $categoryStmt->fetch();
    $categoryName = $category['name'];
    $title = "Jo's Jobs - " . $categoryName . " Jobs";
} else {
    $categoryName = "All";
    $title = "Jo's Jobs - All Jobs";
}

$content = loadTemplate("../templates/jobCategory.html.php", [
    'jobs' => $jobs,
    'category' => $categoryName,
    'titleFilter' => $titleFilter,
    'locationFilter' => $locationFilter
]);

require("../templates/layout.html.php");