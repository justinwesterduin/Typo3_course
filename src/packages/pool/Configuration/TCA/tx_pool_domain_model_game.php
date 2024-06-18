<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game',
        'label' => 'date',
        'tstamp' => 'crdate',
        'delete' => 'deleted',
        'default_sortby' => 'date',
        'iconfile' => 'EXT:my_sitepackage/Resources/Public/Icons/MaxServ.jpg',
        'searchFields' => 'date',
        'enablecolumns' => [
            'fe_group' => 'fe_group',
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'tablename' => 'tx_pool_domain_model_game',
    ],

    'columns' => [
        'date' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.date',
            'config' => [
                'type' => 'datetime',
                'eval' => 'int',
                'default' => 0,
                'required' => true,
            ],
        ],
        'player1' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.player_1',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_pool_domain_model_player',
            ],
        ],
        'player2' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.player_2',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_pool_domain_model_player',
            ],
        ],
        'winner' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.player_winner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_pool_domain_model_player',
            ],
        ],
    ],
    'types' => [
        '1' => [
            'showitem' =>
                '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    date,
                    player1,
                    player2,
                    winner,
                 --div--;LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.tabs.access,
                    --palette--;;hidden,
                    --palette--;;access,',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.hidden,
            ',
        ],
        'access' => [
            'label' => 'LLL:EXT:pool/Resources/Private/Language/locallang_db.xlf:tx_pool_domain_model_game.palettes.access',
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,
                fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,',
        ],
    ],
];