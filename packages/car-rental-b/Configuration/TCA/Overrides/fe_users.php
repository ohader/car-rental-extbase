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
        ['Agent', \OliverHader\CarRentalB\Domain\Model\Agent::class],
        ['Customer', \OliverHader\CarRentalB\Domain\Model\Customer::class],
        ['Mechanic', \OliverHader\CarRentalB\Domain\Model\Mechanic::class],
    ]
);