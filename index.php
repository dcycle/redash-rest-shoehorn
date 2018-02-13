<?php

/**
 * @file
 * Entrypoint for our application.
 */

require_once 'autoload.php';

use myproject\App;

print(App::instance()->run($_GET));
