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
    'template_path' => realpath(null) . '/tests/views',
    'cache_path' => realpath(null) . '/tests/storage/smarty/cache',
    'compile_path' => realpath(null) . '/tests/storage/smarty/compile',
    'plugins_paths' => [
        realpath(null) . '/tests/views/plugins',
    ]

];