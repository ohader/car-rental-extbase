<?php
namespace OliverHader\CarRentalA\Domain\Model;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * Rental
 */
class Rental extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Start date
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $startDate = null;

    /**
     * End date
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $endDate = null;

    /**
     * returnDate
     *
     * @var \DateTime
     */
    protected $returnDate = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Car
     */
    protected $car;

    /**
     * customer
     *
     * @var \OliverHader\CarRentalA\Domain\Model\Customer
     */
    protected $customer = null;

    /**
     * Returns the startDate
     *
     * @return \DateTime $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     *
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the endDate
     *
     * @return \DateTime $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the endDate
     *
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Returns the returnDate
     *
     * @return \DateTime $returnDate
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * Sets the returnDate
     *
     * @param \DateTime $returnDate
     * @return void
     */
    public function setReturnDate(\DateTime $returnDate)
    {
        $this->returnDate = $returnDate;
    }

    /**
     * Returns the customer
     *
     * @return \OliverHader\CarRentalA\Domain\Model\Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Sets the customer
     *
     * @param \OliverHader\CarRentalA\Domain\Model\Customer $customer
     * @return void
     */
    public function setCustomer(\OliverHader\CarRentalA\Domain\Model\Customer $customer)
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
}
