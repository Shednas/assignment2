<?php
require_once '../../functions.php'; // Use require_once to avoid multiple inclusions
require_once '../../loadTemplate.php';

class CategoryController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listCategories() {
        $categories = findAll($this->pdo, 'category');
        $title = "Jo's Jobs - Categories";
        $content = loadTemplate('../../templates/categories.html.php', ['categories' => $categories]);
        require '../../templates/layout.html.php';
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $criteria = ['name' => $_POST['name']];
            insert($this->pdo, 'category', $criteria);
            header('Location: categories.php');
            exit();
        }

        $title = "Jo's Jobs - Add Category";
        $content = loadTemplate('../../templates/addcategory.html.php', []);
        require '../../templates/layout.html.php';
    }
}
?>