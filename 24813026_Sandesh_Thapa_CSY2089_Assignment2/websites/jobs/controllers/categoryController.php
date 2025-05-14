<?php
require_once '../../loadTemplate.php';

class CategoryController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function list() {
        $categories = $this->pdo->query('SELECT * FROM category')->fetchAll();
        $title = "Jo's Jobs - Categories";
        $content = loadTemplate('../../templates/categories.html.php', [
            'categories' => $categories,
            'pdo' => $this->pdo
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('INSERT INTO category (name) VALUES (:name)');
            $stmt->execute(['name' => $_POST['name']]);
            header('Location: categories.php');
            exit();
        }
        $title = "Jo's Jobs - Add Category";
        $content = loadTemplate('../../templates/addcategory.html.php', [
            'pdo' => $this->pdo
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare('UPDATE category SET name = :name WHERE id = :id');
            $stmt->execute(['name' => $_POST['name'], 'id' => $_POST['id']]);
            header('Location: categories.php');
            exit();
        }
        $currentCategory = $this->pdo->query('SELECT * FROM category WHERE id = ' . (int)$id)->fetch();
        $title = "Jo's Jobs - Edit Category";
        $content = loadTemplate('../../templates/editcategory.html.php', [
            'currentCategory' => $currentCategory,
            'pdo' => $this->pdo
        ]);
        $pdo = $this->pdo;
        require '../../templates/layout.html.php';
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM category WHERE id = :id');
        $stmt->execute(['id' => $id]);
        header('Location: categories.php');
        exit();
    }
}
?>