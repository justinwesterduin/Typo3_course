<?php
declare(strict_types=1);

use Maxserv\Sitepackage\Controller\SitepackageController;

return [
    'web_sitepackage' => [
        'parent' => 'web',
        'position' => ['top'],
        'access' => 'user',
        'workspaces' => 'live',
        'iconIdentifier' => 'sitepackageicon',
        'path' => '/module/page/sitepackage',
        'labels' => 'LLL:EXT:sitepackage/Resources/Private/Language/sitepackage.xlf',
        'routes' => [
            '_default' => [
                //Hoe te doen met DI?
                'target' => SitepackageController::class,
            ]
        ]
    ],
];