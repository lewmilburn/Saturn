<?php
use Saturn\SecurityManager\XSS;

$XSS = new XSS();

if (!isset($ErrorCode)) {
    $ErrorCode = 'Unknown';
}
if (!isset($ErrorDescription)) {
    $ErrorDescription = 'Unknown';
}
if (!isset($ErrorName)) {
    $ErrorName = 'Unknown';
}
if (!isset($ErrorMessage)) {
    $ErrorMessage = 'Unknown';
}
?><!DOCTYPE html>
<html lang="<?= WEBSITE_LANGUAGE; ?>">
    <head>
        <title><?= __('Error'); ?> <?= Out($ErrorCode); ?> - <?= Out(WEBSITE_NAME); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex">
        <meta name="charset" content="<?= WEBSITE_CHARSET; ?>">

        <link rel="stylesheet" type="text/css" href="<?= Out(SATURN_ROOT); ?>/Assets/CSS/Saturn.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="body">
        <nav class="navigation">
            <a href="/" class="navigation-item"><?= __('Home'); ?></a>
        </nav>

        <main class="main">
            <img src="<?= Out(SATURN_ROOT); ?>/Assets/Images/Saturn-logo.webp" class="w-1/4 mx-auto" alt="Logo">

            <div class="pb-8">
                <h1 class="text-header text-center">
                    <?= __('Error'); ?> <?= Out($ErrorCode); ?>
                </h1>

                <p class="text-subheader-nopt text-center"><?= Out($ErrorName); ?></p>

                <br>

                <p class="text-error">
                    <?= Out($ErrorDescription); ?>
                </p>
            </div>

            <div class="pb-8">
                <h2 class="text-subheader">
                    <?= __('Error_Information'); ?>
                </h2>
                <p class="text-error">
                    <?= Out($ErrorMessage); ?>
                </p>
            </div>

            <div class="pb-8">
                <h2 class="text-subheader">
                    <?= __('Server_Information'); ?>
                </h2>
                <?php if (PHP_VERSION < SATSYS_RECOMMENDED_PHP && WEBSITE_ENV == 0) { ?><div class="alert-warning mb-2 mt-1">
                    <div class="alert-warning-icon">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                    </div>
                    <p class="alert-warning-text">
                        <strong>Warning:</strong> Saturn recommends using PHP <?= SATSYS_RECOMMENDED_PHP; ?> or higher.
                    </p>
                </div><?php }  ?>
                <table class="w-full" role="presentation">
                    <tr>
                        <td class="td"><?= __('Request_URI'); ?></td>
                        <td class="td"><?= Out($_SERVER['REQUEST_URI']); ?></td>
                    </tr>
                    <tr>
                        <td class="td"><?= __('Server_Protocol'); ?></td>
                        <td class="td"><?= Out($_SERVER['SERVER_PROTOCOL']); ?></td>
                    </tr>
                    <tr>
                        <td class="td"><?= __('Request_Time'); ?></td>
                        <td class="td"><?= Out(date('Y-m-d h:i:s')); ?></td>
                    </tr>
                    <tr>
                        <td class="td"><?= __('Request_IP'); ?></td>
                        <td class="td"><?= Out($_SERVER['REMOTE_ADDR']); ?></td>
                    </tr>
                    <?php if (WEBSITE_ENV === ENV_PROD) { ?>
                        <tr>
                            <td class="td" colspan="2">To see more advanced information please switch your website environment to development (0).</td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td class="td"><?= __('Software_Version'); ?></td>
                            <td class="td"><?= Out(SATSYS_VERSION); ?></td>
                        </tr>
                        <tr>
                            <td class="td"><?= __('PHP_Version'); ?></td>
                            <td class="td"><?= Out(PHP_VERSION); ?></td>
                        </tr>
                        <tr>
                            <td class="td"><?= __('Operating_System'); ?></td>
                            <td class="td"><?= Out(PHP_OS); ?></td>
                        </tr>
                        <tr>
                            <td class="td"><?= __('Server_Software'); ?></td>
                            <td class="td"><?= Out($_SERVER['SERVER_SOFTWARE']); ?></td>
                        </tr>
                        <tr>
                            <td class="td"><?= __('Server_Port'); ?></td>
                            <td class="td"><?= Out($_SERVER['SERVER_PORT']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </main>
    </body>
</html>