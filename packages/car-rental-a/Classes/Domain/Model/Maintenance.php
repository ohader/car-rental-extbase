<?php
namespace OliverHader\CarRentalA\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * Maintenance
 */
class Maintenance extends AbstractEntity
{
    /**
     * Start date
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $issueDate = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Car
     */
    protected $car;

    /**
     * customer
     *
     * @var \OliverHader\CarRentalA\Domain\Model\Mechanic
     */
    protected $mechanic = null;

    /**
     * Returns the startDate
     *
     * @return \DateTime
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Sets the startDate
     *
     * @param \DateTime $issueDate
     * @return void
     */
    public function setIssueDate(\DateTime $issueDate)
    {
        $this->issueDate = $issueDate;
    }

    /**
     * @return \OliverHader\CarRentalA\Domain\Model\Mechanic
     */
    public function getMechanic()
    {
        return $this->mechanic;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Mechanic $mechanic
     * @return void
     */
    public function setMechanic(\OliverHader\CarRentalA\Domain\Model\Mechanic $mechanic)
    {
        $this->mechanic = $mechanic;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car;
    }

    /**
     * @param Car $car
     */
    public function setCar(Car $car)
    {
        $this->car = $car;
    }
}
