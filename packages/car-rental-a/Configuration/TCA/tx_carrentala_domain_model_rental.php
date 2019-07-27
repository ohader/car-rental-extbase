<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental',
        'label' => 'start_date',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'start_date,end_date,return_date,customer',
        'iconfile' => 'EXT:car_rental_a/Resources/Public/Icons/rental.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, start_date, end_date, return_date, customer, agent',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, start_date, end_date, return_date, customer, agent, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_carrentala_domain_model_rental',
                'foreign_table_where' => 'AND tx_carrentala_domain_model_rental.pid=###CURRENT_PID### AND tx_carrentala_domain_model_rental.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime,int',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'start_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental.start_date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime,required',
                'default' => '0000-00-00 00:00:00'
            ],
        ],
        'end_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental.end_date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime,required',
                'default' => '0000-00-00 00:00:00'
            ],
        ],
        'return_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental.return_date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime,required',
                'default' => '0000-00-00 00:00:00'
            ],
        ],
        'customer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental.customer',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'AND fe_users.tx_extbase_type="' . str_replace('\\', '\\\\', \OliverHader\CarRentalA\Domain\Model\Customer::class) . '"',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'agent' => [
            'exclude' => true,
            'label' => 'LLL:EXT:car_rental_a/Resources/Private/Language/locallang_db.xlf:tx_carrentala_domain_model_rental.agent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'AND fe_users.tx_extbase_type="' . str_replace('\\', '\\\\', \OliverHader\CarRentalA\Domain\Model\Agent::class) . '"',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],

        'car' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
