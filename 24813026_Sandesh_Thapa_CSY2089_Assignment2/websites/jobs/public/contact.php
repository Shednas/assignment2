<?php
require '../loadTemplate.php';
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');

$message = '';
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('INSERT INTO enquiries (first_name, surname, email, telephone, enquiry) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([
        $_POST['first_name'],
        $_POST['surname'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['enquiry']
    ]);
    $message = 'Thank you for your enquiry. We will get back to you soon.';
}

$title = "Contact Jo's Jobs";
$content = loadTemplate("../templates/contact.html.php", ['message' => $message]);
require("../templates/layout.html.php");
