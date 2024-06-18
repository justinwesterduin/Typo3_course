<?php

return [

    'ctrl' => [
        'title' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player',
        'label' => 'name',
        'tstamp' => 'crdate',
        'delete' => 'deleted',
        'default_sortby' => 'name',
        'iconfile' => 'EXT:my_sitepackage/Resources/Public/Icons/MaxServ.jpg',
        'searchFields' => 'name',
        'enablecolumns' => [
            'fe_group' => 'fe_group',
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'tablename' => 'tx_pool_domain_model_player',
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'email' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.email',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'game' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.game',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_pool_domain_model_game',
            ],
        ],
    ],

    'types' => [
        '1' => [
            'showitem' =>
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    name,
                    email,
                 --div--;LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.tabs.access,
                    --palette--;;hidden,
                    --palette--;;access,',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.hidden
            ',
        ],
        'access' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_player.palettes.access',
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,
                fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,',
        ],
    ],
];