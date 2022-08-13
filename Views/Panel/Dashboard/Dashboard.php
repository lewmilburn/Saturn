<?php
use Saturn\ClientKit\SecureArea;
use Saturn\ClientKit\Translate;

$TL = new Translate();
$SecureArea = new SecureArea();

require_once __DIR__.'/../../../Processes/Controllers/Panel/Dashboard/DashErrors.php';

?><!DOCTYPE html>
<html lang="<?= PANEL_LANGUAGE; ?>" class="min-h-full">
    <head>
        <?php require_once __DIR__.'/../Vendors.inc'; ?>

        <title><?= $TL->TL('Saturn'); ?> <?= $TL->TL('Dashboard'); ?> - <?= WEBSITE_NAME; ?></title>
        <?php global $Plugins; $Plugins->ExecuteHook('PANEL_HEAD_END'); ?>

    </head>
    <body class="dark:bg-black dark:text-white w-full min-h-screen flex flex-col">
        <?php require_once __DIR__.'/../Header.inc'; ?>

        <div class="md:grid xl:grid-cols-8 md:grid-cols-4 w-full flex-grow">
            <?php require_once __DIR__.'/../Sidebar.inc'; ?>

            <div class="h-full w-full py-8 px-10 xl:col-span-7 md:col-span-3">
                <h1 class="text-3xl font-bold mb-8"><?= $TL->TL('Dashboard'); ?></h1>

                <div class="flex space-x-8">
                    <div class="flex-grow shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-neutral-50 dark:bg-neutral-800" id="Pages">
                        <a href="/panel/pages">
                            <div class="flex items-center">
                                <div class="bg-neutral-200 dark:bg-neutral-900 h-8 w-8 rounded-full relative text-center">
                                    <div class="absolute top-[12%] left-[27%]"><i class="far fa-file fa-lg text-neutral-700 dark:text-white" aria-hidden="true"></i></div>
                                </div>
                                <p class="text-2xl ml-2">
                                    <?= $TL->TL('Pages'); ?>
                                </p>
                            </div>
                            <div class="flex flex-col justify-start">
                                <p class="text-4xl text-left font-bold my-4" id="PageCount">0</p>
                            </div>
                        </a>
                    </div>
                    <div class="flex-grow shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-neutral-50 dark:bg-neutral-800" id="Articles">
                        <a href="/panel/articles">
                            <div class="flex items-center">
                                <div class="bg-neutral-200 dark:bg-neutral-900 h-8 w-8 rounded-full relative text-center">
                                    <div class="absolute top-[12%] left-[18%]"><i class="far fa-newspaper fa-lg text-neutral-700 dark:text-white" aria-hidden="true"></i></div>
                                </div>
                                <p class="text-2xl ml-2">
                                    <?= $TL->TL('Articles'); ?>
                                </p>
                            </div>
                            <div class="flex flex-col justify-start">
                                <p class="text-4xl text-left font-bold my-4" id="ArticleCount">0</p>
                            </div>
                        </a>
                    </div>
                    <div class="flex-grow shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-neutral-50 dark:bg-neutral-800 hidden" id="PendingActions">
                        <a href="/panel/actions">
                            <div class="flex items-center">
                                <div class="bg-neutral-200 dark:bg-neutral-900 h-8 w-8 rounded-full relative text-center">
                                    <div class="absolute top-[12%] left-[18%]"><i class="fas fa-search fa-lg text-neutral-700 dark:text-white" aria-hidden="true"></i></div>
                                </div>
                                <h2 class="text-2xl ml-2">
                                    <?= $TL->TL('PendingActions'); ?>
                                </h2>
                            </div>
                            <div class="flex flex-col justify-start">
                                <p class="text-4xl text-left font-bold my-4" id="PendingActionCount">0</p>
                            </div>
                        </a>
                    </div>
                </div>

                <?php if (isset($DashErrors) && $DashErrors != '') { ?>
                <div class="shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-red-50 dark:bg-red-800 mt-8">
                    <div class="flex flex-col justify-start">
                        <h2 class="text-3xl font-bold mb-4"><i class="fa-solid fa-triangle-exclamation text-red-500" aria-hidden="true"></i> <?= $TL->TL('Warnings'); ?></h2>
                        <p class="text-xl text-left my-4">
                            <?= $DashErrors; ?>
                        </p>
                    </div>
                </div>
                <?php } ?>

                <div class="shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-neutral-50 dark:bg-neutral-800 mt-8">
                    <a href="/panel/analytics">
                        <div class="flex flex-col justify-start">
                            <h2 class="text-3xl font-bold mb-4"><?= $TL->TL('Analytics'); ?></h2>
                            <p class="text-xl text-left my-4">
                                0 Views today.
                            </p>
                        </div>
                    </a>
                </div>

                <div class="shadow-lg hover:shadow-xl transition-shadow duration-200 w-auto p-4 bg-neutral-50 dark:bg-neutral-800 mt-8">
                    <a href="/panel/tasks">
                        <div class="flex flex-col justify-start">
                            <h2 class="text-3xl font-bold mb-4"><?= $TL->TL('Tasks'); ?></h2>
                            <div class="text-left my-4 grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-xl mb-4"><?= $TL->TL('Tasks_My'); ?></h3>
                                    <p><input type="checkbox"> Complete UI</p>
                                    <p><input type="checkbox"> Make stuff work</p>
                                </div>
                                <div>
                                    <h3 class="text-xl mb-4"><?= $TL->TL('Tasks_Team'); ?></h3>
                                    <p><input type="checkbox" checked disabled> <?= $TL->TL('Tasks_Done'); ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php global $Plugins; $Plugins->ExecuteHook('PANEL_DASH_WIDGETS_END'); ?>

            </div>
        </div>
    </body>
    <?php global $API_LOCATION; ?>

    <script>
        fetch('<?= $API_LOCATION; ?>/<?= API_VERSION; ?>/page/count')
            .then(response=>response.text())
            .then(data=>{ document.getElementById('PageCount').innerText = data; })
        fetch('<?= $API_LOCATION; ?>/<?= API_VERSION; ?>/article/count')
            .then(response=>response.text())
            .then(data=>{ document.getElementById('ArticleCount').innerText = data; })
        fetch('<?= $API_LOCATION; ?>/<?= API_VERSION; ?>/action/count/pending')
            .then(response=>response.text())
            .then(data=>{
                if (data != 'disabled') {
                    document.getElementById('PendingActions').classList.remove("hidden");
                    document.getElementById('PendingActionCount').innerText = data;
                }
            })
    </script>
</html>