<?php
// index.php inside src/Routes/ folder

use Mikelnavarro\App\Controllers\HomeController;
use App\Router;

$router = new Router();

// Define a route for the home page
$router->get('/', HomeController::class, 'index');

// Dispatch routes
$router->dispatch();