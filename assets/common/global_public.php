<?php

    ob_start();
    /* Load Configuration */
    require_once __DIR__.'/../../config.php';
    require_once __DIR__.'/../../theme.php';
    /* Important Functions */
    require_once __DIR__.'/processes/database/connect.php';
    require_once __DIR__.'/processes/security/security.php';
    require_once __DIR__.'/processes/errorHandler.php';
    set_error_handler('errorHandlerError', E_ERROR);
    set_error_handler('errorHandlerWarning', E_WARNING);
    /* Developer Tools */
    if (CONFIG_DEBUG) {
        log_console('SATURN][DEBUG', 'Debug Mode is ENABLED. This is NOT recommended in production environments. You can disable this in your site configuration settings.');
    }
    /* Database: Required Files */
    require_once __DIR__.'/processes/database/get/announcement.php';
    require_once __DIR__.'/processes/database/get/articles.php';
    require_once __DIR__.'/processes/database/get/page.php';
    require_once __DIR__.'/processes/database/get/user.php';
    /* Required Files */
    require_once __DIR__.'/processes/resource_loader/resource_loader.php';
    require_once __DIR__.'/processes/email.php';
    require_once __DIR__.'/processes/gui/alerts.php';
    /* Require HTTPS */
    if ($_SERVER['HTTPS'] != 'on' && SECURITY_USE_HTTPS) {
        header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit();
    }
    if (get_announcement_website_active()) {
        echo alert(get_announcement_website_type(), '<span class="underline">'.get_announcement_website_title().':</span> '.get_announcement_website_message(), true);
    }
    ob_end_flush();
