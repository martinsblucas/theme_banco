<?php
$_GET['page'] ? $page = $_GET['page'] : $page = null;
switch ($page) {
    case 'add':
        include (__DIR__.'/add.php');
        break;
    default:
        include (__DIR__.'/all.php');
        break;
}