<?php
namespace HofUniversityIndie\CarRental\Hook;

class RealUrlConfiguration
{
    const BRAND_CONFIGURATION = [
        'table' => 'tx_carrental_domain_model_brand',
        'id_field' => 'uid',
        'alias_field' => 'name',
        'useUniqueCache' => 1,
        'useUniqueCache_conf' => [
            'strtolower' => 1,
            'spaceCharacter' => '-',
        ],
    ];
    const CAR_CONFIGURATION = [
        'table' => 'tx_carrental_domain_model_car',
        'id_field' => 'uid',
        'alias_field' => 'vin',
        'useUniqueCache' => 1,
        'useUniqueCache_conf' => [
            'strtolower' => 1,
            'spaceCharacter' => '-',
        ],
    ];

    /**
     * Enrich RealURL configuration with our own configuration.
     *
     * @param array $parameters
     * @return array
     */
    public function add(array $parameters)
    {
        if (empty($parameters['config']['postVarSets']['_DEFAULT'])) {
            $parameters['config']['postVarSets']['_DEFAULT'] = [];
        }
        $parameters['config']['postVarSets']['_DEFAULT'] = array_merge(
            $parameters['config']['postVarSets']['_DEFAULT'],
            [
                'CRi' => [
                    [
                        'GETvar' => 'tx_carrental_information[car]',
                        'lookUpTable' => static::CAR_CONFIGURATION,
                    ],
                    [
                        'GETvar' => 'tx_carrental_information[action]',
                    ],
                    [
                        'GETvar' => 'tx_carrental_information[controller]',
                    ],
                ],
                'CRr' => [
                    [
                        'GETvar' => 'tx_carrental_rental[car]',
                        'lookUpTable' => static::CAR_CONFIGURATION,
                    ],
                    [
                        'GETvar' => 'tx_carrental_rental[action]',
                        'noMatch' => 'bypass',
                    ],
                    [
                        'GETvar' => 'tx_carrental_rental[controller]',
                        'noMatch' => 'bypass',
                    ],
                ],
                'CRm' => [
                    [
                        'GETvar' => 'tx_carrental_management[car]',
                        'lookUpTable' => static::CAR_CONFIGURATION,
                    ],
                    [
                        'GETvar' => 'tx_carrental_management[action]',
                        'noMatch' => 'bypass',
                    ],
                    [
                        'GETvar' => 'tx_carrental_management[controller]',
                        'noMatch' => 'bypass',
                    ],
                ],
            ]
        );

        return $parameters['config'];
    }
}