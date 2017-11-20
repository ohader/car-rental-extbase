<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'HofUniversityIndie.CarRental',
            'Information',
            'Information'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('car_rental', 'Configuration/TypoScript', 'Car Rental');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrental_domain_model_brand', 'EXT:car_rental/Resources/Private/Language/locallang_csh_tx_carrental_domain_model_brand.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrental_domain_model_brand');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrental_domain_model_car', 'EXT:car_rental/Resources/Private/Language/locallang_csh_tx_carrental_domain_model_car.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrental_domain_model_car');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_carrental_domain_model_tire', 'EXT:car_rental/Resources/Private/Language/locallang_csh_tx_carrental_domain_model_tire.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_carrental_domain_model_tire');

    }
);
