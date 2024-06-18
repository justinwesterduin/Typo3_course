<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;

return [
    'mysitepackageicon' => [
        'provider' => BitmapIconProvider::class,
        'source' => 'EXT:my_sitepackage/Resources/Public/Icons/MaxServ.jpg',
    ],
    'mycustomcontacticon' => [
        'provider' => BitmapIconProvider::class,
        'source' => 'EXT:my_sitepackage/Resources/Public/Icons/MaxServ.jpg',
    ],
];