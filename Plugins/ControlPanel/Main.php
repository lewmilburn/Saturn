<?php

use ControlPanel\CPRouter;
use Saturn\HTTP\Router;

require_once __DIR__.'/CPRouter.php';

$Router = new Router();

global $Actions;
$Actions->Register('RouteRegister', [new CPRouter(), 'Register'], [$Router]);
