<?php
declare(strict_types=1);
defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_mysitepackage_customcontact_socials',
    'socialmedialinks',
    'socials_name, socials_link',
);

return [
    'ctrl' => [
        'title' => 'Social networks',
        'label' => 'socials_name',
        'iconfile' => 'EXT:my_sitepackage/Resources/Public/Icons/MaxServ.jpg',
        'tablename' => 'tx_mysitepackage_customcontact_socials',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'columns' => [
        'socials_name' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:socialsName',
            'description' => 'Add social media names',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'socials_link' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:socialsUrl',
            'description' => 'Social media link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],

    ],
    'palettes' => [
        'test_palette' => [
            'showitem' => 'socials_name, socials_link'
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;palette,
                    --palette--;;test_palette,
                    --palette--;;test_palette,
                --div--;palette,
                    --palette--;;test_palette,
            ',
        ],
    ],
];

