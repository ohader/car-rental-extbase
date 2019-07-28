<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        // configure Extbase plugin, used to control MVC dispatcher logic
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.CarRentalB',
            'Information',
            [
                'Car' => 'list, show, showMaintenance'
            ],
            // non-cacheable actions
            [
                'Car' => ''
            ]
        );
        // configure Extbase plugin, used to control MVC dispatcher logic
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.CarRentalB',
            'Rental',
            [
                'Rental' => 'list, new, create, delete, notLoggedInError'
            ],
            // non-cacheable actions
            [
                'Rental' => 'list, new, create, delete'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.CarRentalB',
            'Management',
            [
                'Management' => 'list, show, edit, update, delete, status'
            ],
            // non-cacheable actions
            [
                'Management' => 'edit, update, delete, status'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.CarRentalB',
            'Json',
            [
                'Json' => 'list'
            ],
            // non-cacheable actions
            [
            ]
        );

        // add dedicated visualization in backend when "adding new content element"
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:car_rental_b/Configuration/TSconfig/Page/All.tsconfig">'
        );

        // register different icons for different plugin-types, shown in backend
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'car_rental_b-plugin-information',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:car_rental_b/Resources/Public/Icons/user_plugin_information.svg']
        );
        $iconRegistry->registerIcon(
            'car_rental_b-plugin-rental',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:car_rental_b/Resources/Public/Icons/user_plugin_rental.svg']
        );
        $iconRegistry->registerIcon(
            'car_rental_b-plugin-management',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:car_rental_b/Resources/Public/Icons/user_plugin_management.svg']
        );
        // register Extbase import command controller
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers']['car_rental']
            = \OliverHader\CarRentalB\Command\ExtbaseCommandController::class;
    }
);