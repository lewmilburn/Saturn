<?php

use ControlPanel\CPRouter;
use Saturn\HTTP\Router;

require __DIR__ . '/CPRouter.php';

$Router = new Router();

global $Actions;
$Actions->Register('RouteRegister',  array(new CPRouter(),'Register'), array($Router));