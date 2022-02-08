<?php

/**
 * The local.php settings will overrule that from global.php.
 *
 *
 */
return [
    ...(require __DIR__ . '/autoload/global.php'),
    ...(file_exists('/autoload/local.php') ? require __DIR__ . '/autoload/local.php' : [])
];
