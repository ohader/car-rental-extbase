<?php
namespace OliverHader\CarRentalB\Domain\Model\Common;

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
 * Car Interface
 */
interface CarInterface
{
    public function getVin(): string;
    public function getColor(): string;
    public function getBrand();
}
