<?php

require '../database.php';
require '../functions.php';

delete($pdo, 'joke', $_POST['id']);

header('location: jokes.php');