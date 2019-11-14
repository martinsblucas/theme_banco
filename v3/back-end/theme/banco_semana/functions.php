<?php

define('APP_DIR', __DIR__ . '/app/');
use Controllers\StylesEnqueue;
include (APP_DIR.'controllers/StylesEnqueue.php');

try {
    new StylesEnqueue();
}
catch (Exception $e) {

}