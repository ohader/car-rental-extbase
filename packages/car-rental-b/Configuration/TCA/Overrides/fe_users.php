<?php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'fe_users',
    [
        'employee_number' => [
            'label' => 'Employee Number',
            'config' => [
                'type' => 'input',
            ]
        ],
    ]
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'employee_number'
);
$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['items'] = array_merge(
    $GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['items'] ?? [],
    [
        ['Agent', 'car-rental-agent'],
        ['Customer', 'car-rental-customer'],
        ['Mechanic', 'car-rental-mechanic'],
    ]
);