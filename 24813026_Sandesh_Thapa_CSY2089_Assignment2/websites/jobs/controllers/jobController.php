<?php
require_once '../../functions.php';
require_once '../../loadTemplate.php';

class JobController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function list($filter = []) {
        $sql = 'SELECT job.*, category.name AS category_name FROM job JOIN category ON job.categoryId = category.id';
        $params = [];
        if (!empty($filter['categoryId'])) {
            $sql .= ' WHERE job.categoryId = :categoryId';
            $params['categoryId'] = $filter['categoryId'];
        }
        $sql .= ' ORDER BY job.closingDate DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $jobs = $stmt->fetchAll();
        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();
        $title = "Jo's Jobs - Jobs list";
        $content = loadTemplate('../../templates/jobs.html.php', [
            'pdo' => $this->pdo,
            'jobs' => $jobs,
            'categories' => $categories,
            'categoryFilter' => $filter['categoryId'] ?? null
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('INSERT INTO job (title, description, salary, location, closingDate, categoryId)
                VALUES (:title, :description, :salary, :location, :closingDate, :categoryId)');
            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate']
            ]);
            header('Location: jobs.php');
            exit();
        }
        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();
        $title = "Jo's Jobs - Add Job";
        $content = loadTemplate('../../templates/addjob.html.php', [
            'pdo' => $this->pdo,
            'categories' => $categories,
            'message' => ''
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('UPDATE job SET title = :title, description = :description, salary = :salary, location = :location, categoryId = :categoryId, closingDate = :closingDate WHERE id = :id');
            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
                'id' => $_POST['id']
            ]);
            header('Location: jobs.php');
            exit();
        }
        $stmt = $this->pdo->prepare('SELECT * FROM job WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $job = $stmt->fetch();
        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();
        $title = "Jo's Jobs - Edit Job";
        $content = loadTemplate('../../templates/editjob.html.php', [
            'job' => $job,
            'categories' => $categories
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM job WHERE id = :id');
        $stmt->execute(['id' => $id]);
        header('Location: jobs.php');
        exit();
    }
}
