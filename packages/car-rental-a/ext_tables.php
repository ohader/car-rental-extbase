<?php
defined('TYPO3_MODE') || die('Access denied.');

// anonymous function call to avoid polluting global
// scope with temporary variable names and values
// (superfluous here since no variables are used)
call_user_func(
    function()
    {
        // Define plugins to be selectable in plugin-type list
        // when editing content element in backend
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.CarRentalA',
            'Information',
            'Information',
            'car_rental_a-plugin-information'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.CarRentalA',
            'Rental',
            'Rental',
            'car_rental_a-plugin-rental'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.CarRentalA',
            'Management',
            'Management',
            'car_rental_a-plugin-management'
        );

        // Add TypoScript static template for frontend rendering
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('car_rental_a', 'Configuration/TypoScript', 'Car Rental');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrentala_domain_model_brand', 'EXT:car_rental_a/Resources/Private/Language/locallang_csh_tx_carrentala_domain_model_brand.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrentala_domain_model_brand');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrentala_domain_model_car', 'EXT:car_rental_a/Resources/Private/Language/locallang_csh_tx_carrentala_domain_model_car.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrentala_domain_model_car');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrentala_domain_model_tire', 'EXT:car_rental_a/Resources/Private/Language/locallang_csh_tx_carrentala_domain_model_tire.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrentala_domain_model_tire');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrentala_domain_model_rental', 'EXT:car_rental_a/Resources/Private/Language/locallang_csh_tx_carrentala_domain_model_rental.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrentala_domain_model_rental');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrentala_domain_model_customer', 'EXT:car_rental_a/Resources/Private/Language/locallang_csh_tx_carrentala_domain_model_customer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrentala_domain_model_customer');

    }
);
