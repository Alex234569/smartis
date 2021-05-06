<?php

use app\core\Controller;

define ('DIR', $_SERVER['DOCUMENT_ROOT']);
require_once 'core/autoloader.php';
require_once DIR . "/app/views/Template.php";  // подключение освной (и единственной) страницы


$controller = new Controller();
$controller->start();