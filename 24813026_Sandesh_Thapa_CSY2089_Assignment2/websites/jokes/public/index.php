<?php
require '../loadTemplate.php';
require '../database.php';
require '../functions.php';

$title = 'Internet Joke Database';

$joke = find($pdo, 'joke', 'id', 1);

$output = loadTemplate('../templates/home.html.php', ['joke' => $joke[0]]);

require  '../templates/layout.html.php';