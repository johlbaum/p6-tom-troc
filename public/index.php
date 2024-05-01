<?php

require_once('../config/config.php');
require_once('../app/controllers/BookController.php');

$bookController = new BookControler();
$bookController->showHome();
