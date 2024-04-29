<?php
use Saturn\HookManager\Actions;
use Saturn\PluginManager\PluginManifest;
require_once __DIR__ . '/Include/Security.php';
?><!DOCTYPE html>
<html lang="<?= WEBSITE_LANGUAGE; ?>">
    <head>
        <title><?= __CP('Pages'); ?> - <?= WEBSITE_NAME ?> <?= __CP('ControlPanel'); ?></title>
        <?php require_once __DIR__ . '/Include/Header.php'; ?>
    </head>
    <body class="body">
        <?php require_once __DIR__ . '/Include/Navigation.php'; ?>
        <main class="main">
            <h1 class="text-header-nopt"><?= __CP('Pages'); ?></h1>
            <?php $Actions = new Actions(); $Actions->Run('ControlPanel.PagesListStart'); ?>
            <div class="grid grid-cols-1 gap-2">
                <?php
                    $DBMS = new \Saturn\DatabaseManager\DBMS();
                    $Pages = $DBMS->Query('SELECT * FROM `'.DB_PREFIX.'pages` WHERE 1');
                    if ($Pages->num_rows != 0) {
                        $Pages = $Pages->fetch_all(MYSQLI_ASSOC);
                        foreach ($Pages as $Page) {
                ?>
                <a class="grid-item-link grid-padding relative" href="<?= SATURN_ROOT; ?><?= CPURL_PANEL; ?><?= CPURL_EDIT; ?>/<?= $Page['id']; ?>">
                    <h2 class="text-3xl font-bold"><?= $Page['title']; ?></h2>
                    <p class="pb-2">
                        <strong><?= $Page['url']; ?></strong>
                    </p>
                </a>
                <?php }} else { ?>
                <p><?= __CP('NoPages'); ?></p>
                <?php } ?>
            </div>
            <?php $Actions = new Actions(); $Actions->Run('ControlPanel.PagesListEnd'); ?>
        </main>

        <script src="<?= SATURN_ROOT; ?>/Plugins/ControlPanel/Assets/JS/Console.js"></script>
    </body>
</html>