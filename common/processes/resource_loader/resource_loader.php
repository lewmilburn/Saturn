<?php

    if (CONFIG_DEBUG === true) {
        log_console('Saturn][Resource Loader', 'RERL has started.');
    }
    require_once 'marketplace.php';
    require_once 'themes.php';
    require_once 'translation.php';
