<?php
defined('TYPO3') or die();

use Maxserv\MySitepackage\Reaction\ClearCacheReaction;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'sys_reaction',
    'reaction_type',
    [
        'label' => ClearCacheReaction::getDescription(),
        'value' => ClearCacheReaction::getType(),
        'ícon' => ClearCacheReaction::getIconIdentifier(),
    ]
);

$GLOBALS['TCA']['sys_reaction']['ctrl']['typeicon_classes'][ClearCacheReaction::getType()] = ClearCacheReaction::getIconIdentifier();

$GLOBALS['TCA']['sys_reaction']['types'][ClearCacheReaction::getType()] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;config,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;access
    ',
];
