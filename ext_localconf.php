<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'HofUniversityIndie.CarRental',
            'Information',
            [
                'Car' => 'list, show'
            ],
            // non-cacheable actions
            [
                'Car' => ''
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    information {
                        iconIdentifier = car_rental-plugin-information
                        title = LLL:EXT:car_rental/Resources/Private/Language/locallang_db.xlf:tx_car_rental_information.name
                        description = LLL:EXT:car_rental/Resources/Private/Language/locallang_db.xlf:tx_car_rental_information.description
                        tt_content_defValues {
                            CType = list
                            list_type = carrental_information
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'car_rental-plugin-information',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:car_rental/Resources/Public/Icons/user_plugin_information.svg']
			);
		
    }
);
