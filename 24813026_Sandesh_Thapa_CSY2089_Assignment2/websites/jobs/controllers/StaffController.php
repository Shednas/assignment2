<?php
require_once '../../loadTemplate.php';

class StaffController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function list() {
        $staff = $this->pdo->query('SELECT id, username, role, cannot_delete FROM staff')->fetchAll();
        $title = "Jo's Jobs - Staff Management";
        $content = loadTemplate('../../templates/staffManagement.html.php', [
            'staff' => $staff,
            'message' => ''
        ]);
        require '../../templates/layout.html.php';
    }

    public function add() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $role = $_POST['role'] ?? 'admin';
            if ($username && $password) {
                $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM staff WHERE username = ?');
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() == 0) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->pdo->prepare('INSERT INTO staff (username, password, role) VALUES (?, ?, ?)')->execute([$username, $hash, $role]);
                    $message = 'Staff added.';
                } else {
                    $message = 'Username already exists.';
                }
            } else {
                $message = 'Username and password required.';
            }
        }
        $staff = $this->pdo->query('SELECT id, username, role, cannot_delete FROM staff')->fetchAll();
        $title = "Jo's Jobs - Staff Management";
        $content = loadTemplate('../../templates/staffManagement.html.php', [
            'staff' => $staff,
            'message' => $message
        ]);
        require '../../templates/layout.html.php';
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('SELECT cannot_delete FROM staff WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row && !$row['cannot_delete']) {
            $this->pdo->prepare('DELETE FROM staff WHERE id = ?')->execute([$id]);
        }
        header('Location: staffManagement.php');
        exit();
    }
}
