<?php
$pdo = new PDO('mysql:host=mysql;dbname=job;charset=utf8', 'student', 'student');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>