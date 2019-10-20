<?php
require_once 'vendor/autoload.php';

use Core\Router\Router;

$router = new Router();
echo $router->handleRequest($_REQUEST);