<?php
require_once './vendor/autoload.php';
require_once("./functions/create.func.php");

use Create as Cre;
use Steampixel\Route;

Route::add('/create', function() {
    $temp = new Cre();
    $temp->create();
}, "POST");