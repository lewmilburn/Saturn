<?php
use Saturn\DatabaseManager\DBMS;
$DBMS = new DBMS();
$Page = $DBMS->Query("SELECT * FROM `".DB_PREFIX."pages` WHERE `url` = '".$DBMS->Escape($_SERVER['REQUEST_URI'])."';");
$PageData = $Page->fetch_object();
?><!DOCTYPE html>
<html lang="<?= WEBSITE_LANGUAGE; ?>">
    <head>
        <title><?= $PageData->title; ?></title>
    </head>
    <body>
        <?= $PageData->content; ?>
    </body>
</html>
