<?php
require_once '../../database.php';
session_start();

require '../../loadTemplate.php';

// Fetch categories for filter dropdown
$categories = $pdo->query('SELECT id, name FROM category')->fetchAll();

// Handle category filter
$categoryFilter = isset($_GET['category']) && $_GET['category'] !== '' ? $_GET['category'] : null;

$params = [];
$sql = 'SELECT job.*, category.name AS category_name FROM job JOIN category ON job.categoryId = category.id';

if ($categoryFilter) {
    $sql .= ' WHERE job.categoryId = :categoryId';
    $params['categoryId'] = $categoryFilter;
}

// Order by closingDate DESC (latest jobs first)
$sql .= ' ORDER BY job.closingDate DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$jobs = $stmt->fetchAll();

$title = "Jo's Jobs - Jobs list";
$content = loadTemplate("../../templates/jobs.html.php", [
    'pdo' => $pdo,
    'jobs' => $jobs,
    'categories' => $categories,
    'categoryFilter' => $categoryFilter
]);

// Remove direct echo of edit link and rely on the template for edit/delete actions

require("../../templates/layout.html.php");
?>