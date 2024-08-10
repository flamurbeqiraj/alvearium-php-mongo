<?php
require_once("./core/cors.core.php");
require_once './vendor/autoload.php';

use Steampixel\Route;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once("routes/create.route.php");
require_once("routes/read.route.php");
require_once("routes/update.route.php");
require_once("routes/delete.route.php");

Route::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404 :-(<br>';
    echo 'The requested path "' . $path . '" was not found!';
});

Route::methodNotAllowed(function ($path, $method) {
    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Error 405 :-(<br>';
    echo 'The requested path "' . $path . '" exists. But the request method "' . $method . '" is not allowed on this path!';
});

// Run the router
Route::run($_ENV['BASEURL']);