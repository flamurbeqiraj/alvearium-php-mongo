<?php
require_once('./vendor/autoload.php');
require_once('./functions/read.func.php');

use Read as Rd;
use Steampixel\Route;

Route::add('/get-single/([a-z-0-9-]*)', function($uuid) {
    $temp = new Rd();
    $temp->read_single($uuid);
}, 'GET');

Route::add('/get-all', function() {
    $temp = new Rd();
    $temp->read_all();
}, 'GET');