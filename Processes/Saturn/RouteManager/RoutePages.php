<?php

namespace Saturn\RouteManager;

use Saturn\DatabaseManager\DBMS;
use Saturn\HTTP\Router;

class RoutePages
{
    public Router $Router;

    public function __construct(Router $Router)
    {
        $this->Router = $Router;
    }

    public function Register(): void
    {
        $DBMS = new DBMS();
        $Page = $DBMS->Query('SELECT * FROM `'.DB_PREFIX."pages` WHERE `url` = '".$DBMS->Escape($_SERVER['REQUEST_URI'])."';");

        if ($Page !== null && $Page->num_rows !== 0) {
            $this->Router->GET($DBMS->Escape($_SERVER['REQUEST_URI']), 'DefaultViews/Page.php');
        } elseif ($DBMS->Escape($_SERVER['REQUEST_URI']) === '/') {
            require_once __DIR__.'/../../DefaultViews/NoHomepage.php';
            exit;
        }
    }
}
