<?php
require_once('./vendor/autoload.php');
require_once('./functions/update.func.php');

use Update as St;
use Steampixel\Route;

Route::add('/update/([a-z-0-9-]*)', function($uuid) {
    $temp = new St();
    $temp->update($uuid);
}, 'PUT');