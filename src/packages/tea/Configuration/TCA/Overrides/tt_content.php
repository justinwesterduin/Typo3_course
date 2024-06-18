<?php

call_user_func(
    static function (): void {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Tea',
        'TeaIndex',
        'Tea Plugin',
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Tea',
            'BrandShow',
            'Brand Plugin',
        );
    }
);