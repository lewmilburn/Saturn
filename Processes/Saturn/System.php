<?php

const SATSYS_VERSION = '1.0.0';
const SATSYS_MINIMUM_PHP = 8;
const SATSYS_RECOMMENDED_PHP = 8.1;
const SATSYS_DOCS_URL = 'https://docs.saturncms.net/v/'.SATSYS_VERSION;
const SATSYS_DISALLOWED_PAGES = ['Assets', 'Plugins', 'Processes', 'Settings', 'Storage', 'Themes', 'panel', 'account', 'api'];

// Website modes
const MODE_MAINT = 1;
const MODE_LIVE = 0;

// Website environemnts
const ENV_PROD = 0;
const ENV_DEV = 1;
