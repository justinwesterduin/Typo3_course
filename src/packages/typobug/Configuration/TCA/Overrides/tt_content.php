<?php
call_user_func(
    static function (): void {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Bug',
            'BugIndex',
            'Bugs everywhere'
        );
    }
);

$GLOBALS['TCA']['tt_content']['types']['bug_bugfixelement'] = [
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
        'label' => 'My typo bug extension test element',
        'value' => 'bug_bugfixelement',
        'group' => 'default',
        'icon' => 'content-package'
    ],
    'header',
    'before'
);
