<?php
require_once '../../loadTemplate.php';

class ClientController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function dashboard($clientId, $clientUsername) {
        $stmt = $this->pdo->prepare('SELECT job.*, category.name AS category_name FROM job JOIN category ON job.categoryId = category.id WHERE job.clientId = :clientId');
        $stmt->execute(['clientId' => $clientId]);
        $jobs = $stmt->fetchAll();
        $title = "Jo's Jobs - Client Dashboard";
        $content = loadTemplate('../../templates/dashboardClient.html.php', [
            'jobs' => $jobs,
            'client_username' => $clientUsername
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function addJob($clientId) {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('INSERT INTO job (title, description, salary, location, closingDate, categoryId, clientId)
                VALUES (:title, :description, :salary, :location, :closingDate, :categoryId, :clientId)');
            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
                'clientId' => $clientId
            ]);
            $message = 'Job Added';
        }
        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();
        $title = "Jo's Jobs - Add Job";
        $content = loadTemplate('../../templates/addjobClient.html.php', [
            'categories' => $categories,
            'message' => $message
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function editJob($clientId, $jobId) {
        // Fetch job and check ownership
        $stmt = $this->pdo->prepare('SELECT * FROM job WHERE id = :id AND clientId = :clientId');
        $stmt->execute(['id' => $jobId, 'clientId' => $clientId]);
        $job = $stmt->fetch();

        if (!$job) {
            $content = "You do not have access to this job or it does not exist.";
            $title = "Edit Job";
            $pdo = $this->pdo;
            require("../../templates/layout.html.php");
            exit;
        }

        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('UPDATE job SET title = :title, description = :description, salary = :salary, location = :location, categoryId = :categoryId, closingDate = :closingDate WHERE id = :id AND clientId = :clientId');
            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
                'id' => $jobId,
                'clientId' => $clientId
            ]);
            header('Location: dashboardClient.php');
            exit;
        }

        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();

        $title = "Edit Job";
        $content = loadTemplate("../../templates/editjobClient.html.php", [
            'job' => $job,
            'categories' => $categories,
            'message' => $message
        ]);
        $pdo = $this->pdo;
        require("../../templates/layout.html.php");
    }

    public function deleteJob($clientId, $jobId) {
        $stmt = $this->pdo->prepare('DELETE FROM job WHERE id = :id AND clientId = :clientId');
        $stmt->execute(['id' => $jobId, 'clientId' => $clientId]);
        header('Location: dashboardClient.php');
        exit;
    }
}
