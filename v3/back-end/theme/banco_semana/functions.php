<?php

define('APP_DIR', __DIR__ . '/app/');

include(APP_DIR . 'controllers/StylesEnqueueController.php');
include(APP_DIR . 'controllers/ScriptsEnqueueController.php');
include(APP_DIR . 'controllers/LocalizeScriptsController.php');
include(APP_DIR . 'controllers/ImgSizesController.php');
include(APP_DIR . 'controllers/PreGetPostsController.php');
include(APP_DIR . 'view/CardsView.php');
include(APP_DIR . 'controllers/ArchiveController.php');
include(APP_DIR . 'controllers/FilmesSearchFormController.php');
include(APP_DIR . 'controllers/FeaturedCardsController.php');
include(APP_DIR . 'controllers/AjaxLoadMoreController.php');

use App\Controllers\StylesEnqueueController;
use App\Controllers\ScriptsEnqueueController;
use App\Controllers\LocalizeScriptsController;
use App\Controllers\ImgSizesController;
use App\Controllers\PreGetPostsController;
use App\Controllers\AjaxLoadMoreController;

try {

    new StylesEnqueueController;
    new ScriptsEnqueueController;
    new ImgSizesController;
    new PreGetPostsController;
    new LocalizeScriptsController;
    new AjaxLoadMoreController;

} catch (Exception $e) {

}