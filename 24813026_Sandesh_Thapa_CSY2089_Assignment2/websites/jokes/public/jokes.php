<?php
require '../loadTemplate.php';

require '../database.php';

require '../functions.php';


$jokes = findAll($pdo, 'joke');

$title = 'Joke list';

$output = loadTemplate('../templates/list.html.php', ['jokes' => $jokes]);



require  '../templates/layout.html.php';