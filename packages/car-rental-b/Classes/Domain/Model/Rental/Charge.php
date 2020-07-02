<?php
namespace OliverHader\CarRentalB\Domain\Model\Rental;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/***
 *
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Oliver Hader <oliver.hader@typo3.org>
 *
 ***/

/**
 * Charge
 */
class Charge extends AbstractEntity
{
    /**
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * @var float
     * @Extbase\Validate("NotEmpty")
     */
    protected $price = 0.0;

    /**
     * @return string $name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
