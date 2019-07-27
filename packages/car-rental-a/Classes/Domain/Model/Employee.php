<?php
namespace OliverHader\CarRentalA\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

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
 * Employee
 */
abstract class Employee extends FrontendUser
{
    /**
     * @var string
     */
    protected $employeeNumber = '';

    /**
     * @return string
     */
    public function getEmployeeNumber(): string
    {
        return $this->employeeNumber;
    }

    /**
     * @param string $employeeNumber
     */
    public function setEmployeeNumber(string $employeeNumber): void
    {
        $this->employeeNumber = $employeeNumber;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (!empty($this->name)) {
            return $this->name;
        }
        return $this->username;
    }
}
