<?php
namespace OliverHader\CarRentalB\Domain\Model\Rental;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * Rental
 */
class Rental extends AbstractEntity
{
    /**
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $startDate = null;

    /**
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $endDate = null;

    /**
     * @var \DateTime
     */
    protected $returnDate = null;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Rental\Car
     */
    protected $car;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Rental\Customer
     */
    protected $customer = null;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Rental\Agent
     */
    protected $agent = null;

    /**
     * @return \DateTime $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \DateTime $returnDate
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * @param \DateTime $returnDate
     * @return void
     */
    public function setReturnDate(\DateTime $returnDate)
    {
        $this->returnDate = $returnDate;
    }

    /**
     * @return \OliverHader\CarRentalB\Domain\Model\Rental\Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Rental\Customer $customer
     * @return void
     */
    public function setCustomer(\OliverHader\CarRentalB\Domain\Model\Rental\Customer $customer)
    {
        $this->customer = $customer;
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

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @param Agent $agent
     */
    public function setAgent(Agent $agent): void
    {
        $this->agent = $agent;
    }
}
