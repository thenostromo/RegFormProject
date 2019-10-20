<?php
require_once 'vendor/autoload.php';

use Core\Router\Router;

$router = new Router();
$router->handleRequest($_REQUEST);