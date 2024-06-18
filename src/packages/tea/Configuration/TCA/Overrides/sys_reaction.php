<?php
defined('TYPO3') or die();

use TTN\Tea\Reaction\CreateNewTeaReaction;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_reaction',
    [
        'storage_pid' => [
            'label' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.storage_pid',
            'description' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.storage_pid.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'pages, tx_tea_domain_model_tea',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'impersonate_user' => [
            'label' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.impersonate_user',
            'description' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.impersonate_user.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'be_users',
                'size' => 1,
                'maxitems' => 1,
                'default' => 4,
            ],
        ],
        'fields' => [
            'label' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.fields',
            'description' => 'LLL:EXT:reactions/Resources/Private/Language/locallang_db.xlf:sys_reaction.fields.description',
            'displayCond' => 'FIELD:table_name:REQ:true',
            'config' => [
                'type' => 'json',
                'renderType' => 'fieldMap',
                'default' => '{}',
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'sys_reaction',
    'reaction_type',
    [
        'label' => CreateNewTeaReaction::getDescription(),
        'value' => CreateNewTeaReaction::getType(),
        'ícon' => CreateNewTeaReaction::getIconIdentifier(),
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'sys_reaction',
    'table_name',
    [
        'label' => 'LLL:EXT:tea/Resources/Private/Language/locallang_db.xlf:tx_tea_domain_model_tea',
        'value' => 'tx_tea_domain_model_tea',
        'icon' => \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconFactory::class)->mapRecordTypeToIconIdentifier('table', []),
    ]
);

$GLOBALS['TCA']['sys_reaction']['ctrl']['typeicon_classes'][CreateNewTeaReaction::getType()] = CreateNewTeaReaction::getIconIdentifier();

$GLOBALS['TCA']['sys_reaction']['types'][CreateNewTeaReaction::getType()] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;config,
        table_name,
        impersonate_user,
        fields,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;access
    ',
];
