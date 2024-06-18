<?php
declare(strict_types=1);

use TTN\Tea\Controller\BackendController;

return [
    'tea' => [
        'parent' => 'web',
        'position' => ['top'],
        'access' => 'user',
        'path' => '/module/tea',
        'appearance' => [
            'renderInModuleMenu' => false,
        ],
        'my_module' => [
            // ...
            'moduleData' => [
                'allowedProperty' => '',
                'anotherAllowedProperty' => true,
            ],
        ],
        'routes' => [
            '_default' => [
                'target' => BackendController::class . '::buttonClicked',
            ]
        ]
    ],
];