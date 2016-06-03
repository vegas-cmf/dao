<?php
return [
    'application' => [
        'modules' => [],
        'autoload' => [
            'App\Initializer' => TESTS_ROOT_DIR . '/fixtures/app/initializers/',
            'App\Shared' => TESTS_ROOT_DIR . '/fixtures/app/shared/'
        ],
        'modulesDirectory' => TESTS_ROOT_DIR . '/fixtures/app/modules/',
        'sharedServices' => [
            'App\Shared\CollectionManager',
            'App\Shared\Mongo',
            'App\Shared\Db'
        ],
        'initializers'=> [
            'App\Initializer\Volt'
        ],
        'view' => [
            'cacheDir' => TESTS_ROOT_DIR . '/app/cache/view/',
            'viewsDir' => TESTS_ROOT_DIR . '/app/',
            'layout' => 'main',
            'layoutsDir' => 'layouts/',
            'engines' => []
        ]
    ]
];