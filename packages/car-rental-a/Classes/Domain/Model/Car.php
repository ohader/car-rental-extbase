<?php
namespace OliverHader\CarRentalA\Domain\Model;

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
class Car extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
    }

    /**
     * @return string $vin
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
     * @return string $color
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
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
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
     * @return \OliverHader\CarRentalA\Domain\Model\Brand $brand
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
     * @param \OliverHader\CarRentalA\Domain\Model\Tire $tire
     * @return void
     */
    public function addTire(\OliverHader\CarRentalA\Domain\Model\Tire $tire)
    {
        $this->tires->attach($tire);
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Tire $tireToRemove The Tire to be removed
     * @return void
     */
    public function removeTire(\OliverHader\CarRentalA\Domain\Model\Tire $tireToRemove)
    {
        $this->tires->detach($tireToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Tire> $tires
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
     * @param \OliverHader\CarRentalA\Domain\Model\Rental $rentalToRemove The Rental to be removed
     * @return void
     */
    public function removeRental(\OliverHader\CarRentalA\Domain\Model\Rental $rentalToRemove)
    {
        $this->rentals->detach($rentalToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalA\Domain\Model\Rental> $rentals
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
}
