<?php
use Acme\IntranetRestaurante\Routes\Router;
$router = new Router();

$router->add('GET', '/users', 'UserController@list');

$router->handleRequest();
?>