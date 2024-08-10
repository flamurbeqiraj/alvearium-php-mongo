<?php
require_once './vendor/autoload.php';
require_once './functions/delete.func.php';

use Delete as Del;
use Steampixel\Route;

Route::add('/delete/([a-z-0-9-]*)', function ($uuid) {
    $temp = new Del();
    $temp->delete($uuid);
}, "DELETE");