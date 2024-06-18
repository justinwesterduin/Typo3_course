<?php
declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Writer\FileWriter;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function ()
    {
        $extensionKey = 'tea';

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addTypoScript(
            $extensionKey,
            'setup',
            '@import "EXT:tea/Configuration/TypoScript/setup.typoscript"',
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility ::addTypoScript(
            $extensionKey,
            'constants',
            '@import "EXT:tea/Configuration/TypoScript/constants.typoscript"',
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility ::configurePlugin(
            'Tea',
            'TeaIndex',
            [
                \TTN\Tea\Controller\TeaController::class => 'index,show'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility ::configurePlugin(
            'Tea',
            'BrandShow',
            [
                \TTN\Tea\Controller\BrandController::class => 'show'
            ]
        );
    }
);
clearstatcache();
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][100] = 'EXT:tea/Resources/Private/Templates/Email';

$GLOBALS['TYPO3_CONF_VARS']['LOG']['TTN']['Tea']['Console']['writerConfiguration'] = [
    LogLevel::CRITICAL => [
        FileWriter::class => [
            'logFile' => Environment::getVarPath() . '/log/tea_data.log',
        ],
    ],
];

$GLOBALS['TYPO3_CONF_VARS']['LOG']['TTN']['Tea']['Reaction']['writerConfiguration'] = [
    LogLevel::NOTICE => [
        FileWriter::class => [
            'logFile' => Environment::getVarPath() . '/log/tea_reaction.log',
        ],
    ],
    LogLevel::ERROR => [
        FileWriter::class => [
            'logFile' => Environment::getVarPath() . '/log/tea_reaction.log',
        ],
    ],
];