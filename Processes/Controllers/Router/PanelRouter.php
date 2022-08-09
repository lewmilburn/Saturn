<?php

global $Router;

use Boa\App;
use Boa\Router\Router;

ob_start();
/**
 * ------ SATURN ROUTER ------
 * This file controls the routing of users around your website's pages.
 *
 * @author      LMWN <contact@lmwn.co.uk>
 * @copyright   Copyright (c), 2021 LMWN & Lewis Milburn
 *
 * This file is a modified version of the demo router provided by https://github.com/bramus/router.
 */
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$App = new App();
$Router = new Router();

// Error Handler
$Router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
});

// Before Router Middleware
$Router->before('GET', '/.*', function () {
    header('X-Powered-By: Boa/Router');
});

// Panel
$Router->get('/panel', function () {
    require_once __DIR__ . '/../../../Views/Panel/Account/Login.php';
});
$Router->post('/panel', function () {
    require_once __DIR__ . '/../../Panel/Account/Login.php';
});

// Register
$Router->get('/panel/register', function () {
    require_once __DIR__ . '/../../../Views/Panel/Account/Register.php';
});

// Reset
$Router->get('/panel/reset', function () {
    require_once __DIR__ . '/../../../Views/Panel/Account/Register.php';
});

// Thunderbirds are go!
$Router->run();

// EOF
ob_end_flush();

