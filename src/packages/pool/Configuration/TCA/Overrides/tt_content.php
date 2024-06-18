<?php

call_user_func(
    static function (): void {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Pool',
        'GameIndex',
        'Pool Game Plugin',
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Pool',
            'PlayerShow',
            'Pool Player Plugin',
        );
    }
);

$GLOBALS['TCA']['tt_content']['types']['pool_poolgameselement'] = [
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
        'label' => 'My pool games element',
        'value' => 'pool_poolgameselement',
        'group' => 'default',
        'icon' => 'content-package'
    ],
    'header',
    'before'
);

$GLOBALS['TCA']['tt_content']['types']['pool_poolplayerselement'] = [
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
        'label' => 'My pool players element',
        'value' => 'pool_poolplayerselement',
        'group' => 'default',
        'icon' => 'content-package'
    ],
    'header',
    'before'
);