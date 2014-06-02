<?php
// smarty configure
return [
    // smarty file extension
    'extension' => 'tpl',
    //
    'debugging' => false,
    // use cache
    'caching' => false,
    //
    'cache_lifetime' => 120,
    //
    'compile_check' => false,
    // delimiters
    // default "{$smarty}"
    'left_delimiter' => '{',
    'right_delimiter' => '}',
    // path info
    'template_path' => app_path() . '/views',
    'cache_path' => app_path() . '/storage/smarty/cache',
    'compile_path' => app_path() . '/storage/smarty/compile',
    'plugins_paths' => [
        app_path() . '/views/smarty/plugins',
    ]
];