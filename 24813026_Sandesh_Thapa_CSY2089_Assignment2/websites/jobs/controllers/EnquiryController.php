<?php
require_once '../../loadTemplate.php';

class EnquiryController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function list() {
        $enquiries = $this->pdo->query('SELECT * FROM enquiry')->fetchAll();
        $title = "Jo's Jobs - Enquiries";
        $content = loadTemplate('../../templates/enquiries.html.php', [
            'enquiries' => $enquiries,
            'message' => ''
        ]);
        require '../../templates/layout.html.php';
    }

    public function respond($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('UPDATE enquiry SET response = :response, status = "Complete" WHERE id = :id');
            $stmt->execute([
                'response' => $_POST['response'],
                'id' => $id
            ]);
        }
        header('Location: enquiries.php');
        exit();
    }
}
