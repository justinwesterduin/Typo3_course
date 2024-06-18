<?php
$GLOBALS[ 'TCA' ][ 'be_users' ][ 'columns' ][ 'realName' ][ 'config' ][ 'max' ] = 40;
$GLOBALS[ 'TCA' ][ 'be_users' ][ 'columns' ][ 'realName' ][ 'config' ][ 'required' ] = true;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addTCAcolumns(
    'be_users',
    [
        'nickname' => [
            'label' => 'Nickname',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 30,
                'required' => true,
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addTCAcolumns(
    'be_users',
    [
        'email2' => [
            'label' => 'LLL:EXT:my_sitepackage/Resources/Private/Language/be_users.xlf:field.email2.label',
            'config' => [
                'type' => 'email',
                'size' => 20,
                'max' => 40,
                'required' => true,
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addToAllTCAtypes(
    'be_users',
    'nickname',
    '',
    'after:password'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addToAllTCAtypes(
    'be_users',
    'email2',
    '',
    'after:email'
);