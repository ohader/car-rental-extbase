<?php
namespace OliverHader\CarRentalB\Domain\Model\Maintenance;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\ObjectManager;

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
     * @param Car $car
     * @param Mechanic $mechanic
     * @param \DateTimeInterface|null $issueDate
     * @return Maintenance
     * @throws \Exception
     */
    static function create(Car $car, Mechanic $mechanic, \DateTimeInterface $issueDate = null)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $target = $objectManager->get(static::class);
        $target->car = $car;
        $target->mechanic = $mechanic;
        $target->issueDate = $issueDate ?? new \DateTimeImmutable('now');
        return $target;
    }

    /**
     * Start date
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $issueDate = null;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Maintenance\Car
     */
    protected $car;

    /**
     * customer
     *
     * @var \OliverHader\CarRentalB\Domain\Model\Maintenance\Mechanic
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
     * @return \OliverHader\CarRentalB\Domain\Model\Maintenance\Mechanic
     */
    public function getMechanic()
    {
        return $this->mechanic;
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Maintenance\Mechanic $mechanic
     * @return void
     */
    public function setMechanic(\OliverHader\CarRentalB\Domain\Model\Maintenance\Mechanic $mechanic)
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
