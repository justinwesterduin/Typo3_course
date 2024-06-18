<?php
declare(strict_types=1);
defined('TYPO3') or die();

// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        // title
        'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang.xlf:test.custom_content_element.label',
        // plugin signature: extkey_identifier
        'value' => 'mysitepackage_newcontentelement',
        // icon identifier
        'icon' => 'mycustomcontacticon',
        // group
        'group' => 'common',
        // description
        'description' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang.xlf:test.custom_content_element.description',
    ],
    'textmedia',
    'after',
);

// Adds the content element icon to TCA typeicon_classes
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['mysitepackage_newcontentelement'] = 'mycustomcontacticon';

$GLOBALS['TCA']['tt_content']['types']['mysitepackage_newcontentelement'] =
    [
        'showitem' =>
            '
            --div--;LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_tabs.xlf:general,
                --palette--;;general,
                companyname,
                extrainfo,
                image,
            --div--;LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_tabs.xlf:address,   
                --palette--;;contact,
            --div--;LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_tabs.xlf:contact,
                --palette--;;communication,
                socials,
            ',

        'columnsOverrides' => [
            'extrainfo' => [
                'config' => [
                    'enableRichtext' => true
                ],
            ],
        ],

    ];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addTCAcolumns(
    'tt_content',
    [
        'companyname' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:companyName',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 40,
            ],
        ],
        'address' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:address',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 60,
            ],
        ],
        'zipcode' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:zipcode',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,alphanum',
                'size' => 20,
                'max' => 6,
            ],
        ],
        'cityname' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:cityName',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
            ],
        ],
        'email' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:email',
            'config' => [
                'type' => 'email',
                'eval' => 'trim,uniqueInPid',
                'size' => 20,
                'max' => 30,
            ],
        ],
        'phone' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:phonenumber',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,num',
                'size' => 20,
                'max' => 15,
            ],
        ],
        'extrainfo' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:extrainfo',
            'config' => [
                'type' => 'text',
            ],
        ],
        'socials' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_fields.xlf:socials',
            'config' => [
                'type' => 'inline',
                'foreign_title' => 'Social Media Links',
                'foreign_table' => 'tx_mysitepackage_customcontact_socials',
                'foreign_field' => 'foreign_uid',
                'foreign_table_field' => 'foreign_table',
                'appearance' => [
                    'collapseAll' => true,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'useSortable' => true,
                    'showPossibleRecordsSelector' => true,
                    'expandSingle' => true,
                ],
            ],
        ],
    ],
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'contact',
    'address, zipcode, cityname',
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'communication',
    'email, phone',
);

//====New custom content element: Products
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['mysitepackage_newcontentelement'] = 'mycustomcontacticon';
$GLOBALS['TCA']['tt_content']['types']['mysitepackage_productelement'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;header
    ',
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'My product element',
        'value' => 'mysitepackage_productelement',
        'group' => 'default',
        'icon' => 'content-package'
    ],
    'header',
    'before'
);
