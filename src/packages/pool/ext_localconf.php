<?php
defined('TYPO3') or die();

call_user_func(function ()
    {
        $extensionKey = 'pool';

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            $extensionKey,
            'setup',
            '@import "EXT:pool/Configuration/TypoScript/setup.typoscript"',
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            $extensionKey,
            'constants',
            '@import "EXT:pool/Configuration/TypoScript/constants.typoscript"',
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pool',
            'GameIndex',
            [
                \MaxServ\Pool\Controller\GameController::class => 'index,show'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pool',
            'PlayerShow',
            [
                \MaxServ\Pool\Controller\PlayerController::class => 'show'
            ]
        );
    }
);