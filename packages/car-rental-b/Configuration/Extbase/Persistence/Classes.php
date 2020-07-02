<?php
declare(strict_types = 1);

return [
    \OliverHader\CarRentalB\Domain\Model\Rental\Agent::class => [
        'tableName' => 'fe_users',
        'recordType' => 'car-rental-agent',
    ],
    \OliverHader\CarRentalB\Domain\Model\Rental\Customer::class => [
        'tableName' => 'fe_users',
        'recordType' => 'car-rental-customer',
    ],
    \OliverHader\CarRentalB\Domain\Model\Maintenance\Mechanic::class => [
        'tableName' => 'fe_users',
        'recordType' => 'car-rental-mechanic',
    ],
    // common boundary
    \OliverHader\CarRentalB\Domain\Model\Common\Brand::class => [
        'tableName' => 'tx_carrentalb_domain_model_brand',
    ],
    // maintenance boundary
    \OliverHader\CarRentalB\Domain\Model\Maintenance\Car::class => [
        'tableName' => 'tx_carrentalb_domain_model_car',
    ],
    \OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance::class => [
        'tableName' => 'tx_carrentalb_domain_model_maintenance',
    ],
    \OliverHader\CarRentalB\Domain\Model\Maintenance\Tire::class => [
        'tableName' => 'tx_carrentalb_domain_model_tire',
    ],
    // rental boundary
    \OliverHader\CarRentalB\Domain\Model\Rental\Car::class => [
        'tableName' => 'tx_carrentalb_domain_model_car',
    ],
    \OliverHader\CarRentalB\Domain\Model\Rental\Charge::class => [
        'tableName' => 'tx_carrentalb_domain_model_charge',
    ],
    \OliverHader\CarRentalB\Domain\Model\Rental\Rental::class => [
        'tableName' => 'tx_carrentalb_domain_model_rental',
    ],
];
