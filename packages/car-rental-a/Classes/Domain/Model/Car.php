<?php
namespace OliverHader\CarRentalA\Domain\Model;

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
 * Car
 */
class Car extends AbstractEntity
{
    /**
     * @var string
     * @validate NotEmpty
     */
    protected $vin = '';

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $color = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @cascade remove
     */
    protected $images = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Brand
     */
    protected $brand = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Charge
     */
    protected $charge = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Tire>
     * @cascade remove
     */
    protected $tires = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Rental>
     * @cascade remove
     */
    protected $rentals = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Maintenance>
     * @cascade remove
     */
    protected $maintenances = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->tires = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->rentals = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->maintenances = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     * @return void
     */
    public function setVin($vin)
    {
        $this->vin = $vin;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return void
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->images->attach($image);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->images->detach($image);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * @return \OliverHader\CarRentalA\Domain\Model\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Brand $brand
     * @return void
     */
    public function setBrand(\OliverHader\CarRentalA\Domain\Model\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return \OliverHader\CarRentalA\Domain\Model\Charge
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Charge $charge
     * @return void
     */
    public function setCharge(\OliverHader\CarRentalA\Domain\Model\Charge $charge)
    {
        $this->charge = $charge;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Tire $tire
     * @return void
     */
    public function addTire(\OliverHader\CarRentalA\Domain\Model\Tire $tire)
    {
        $this->tires->attach($tire);
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Tire $tire
     * @return void
     */
    public function removeTire(\OliverHader\CarRentalA\Domain\Model\Tire $tire)
    {
        $this->tires->detach($tire);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Tire>
     */
    public function getTires()
    {
        return $this->tires;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Tire> $tires
     * @return void
     */
    public function setTires(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tires)
    {
        $this->tires = $tires;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Rental $rental
     * @return void
     */
    public function addRental(\OliverHader\CarRentalA\Domain\Model\Rental $rental)
    {
        $this->rentals->attach($rental);
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Rental $rental
     * @return void
     */
    public function removeRental(\OliverHader\CarRentalA\Domain\Model\Rental $rental)
    {
        $this->rentals->detach($rental);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Rental>
     */
    public function getRentals()
    {
        return $this->rentals;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Rental> $rentals
     * @return void
     */
    public function setRentals(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $rentals)
    {
        $this->rentals = $rentals;
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Maintenance $maintenance
     * @return void
     */
    public function addMaintenance(\OliverHader\CarRentalA\Domain\Model\Maintenance $maintenance)
    {
        $this->maintenances->attach($maintenance);
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Maintenance $maintenance
     * @return void
     */
    public function removeMaintenance(\OliverHader\CarRentalA\Domain\Model\Maintenance $maintenance)
    {
        $this->maintenances->detach($maintenance);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Maintenance>
     */
    public function getMaintenances()
    {
        return $this->maintenances;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Maintenance> $maintenances
     * @return void
     */
    public function setMaintenances(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $maintenances)
    {
        $this->maintenances = $maintenances;
    }
}
