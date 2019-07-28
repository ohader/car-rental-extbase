<?php
namespace OliverHader\CarRentalB\Domain\Model\Rental;

use OliverHader\CarRentalB\Domain\Model\Common\CarInterface;
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
 * Car
 */
class Car extends AbstractEntity implements CarInterface
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
     * @Extbase\ORM\Lazy
     * @Extbase\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Common\Brand
     * @Extbase\ORM\Lazy
     */
    protected $brand = null;

    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Rental\Charge
     */
    protected $charge = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Rental\Rental>
     * @Extbase\ORM\Cascade("remove")
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
        $this->rentals = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return string
     */
    public function getVin(): string
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
    public function getColor(): string
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
     * @return \OliverHader\CarRentalB\Domain\Model\Common\Brand
     */
    public function getBrand()
    {
        // @todo Fluid's VariableExtractor does not know the concept of Extbase's LazyLoadingProxy magic
        return $this->brand->_loadRealInstance();
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Common\Brand $brand
     * @return void
     */
    public function setBrand(\OliverHader\CarRentalB\Domain\Model\Common\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return \OliverHader\CarRentalB\Domain\Model\Rental\Charge
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Rental\Charge $charge
     * @return void
     */
    public function setCharge(\OliverHader\CarRentalB\Domain\Model\Rental\Charge $charge)
    {
        $this->charge = $charge;
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Rental\Rental $rental
     * @return void
     */
    public function addRental(\OliverHader\CarRentalB\Domain\Model\Rental\Rental $rental)
    {
        $this->rentals->attach($rental);
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Rental\Rental $rental
     * @return void
     */
    public function removeRental(\OliverHader\CarRentalB\Domain\Model\Rental\Rental $rental)
    {
        $this->rentals->detach($rental);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Rental\Rental>
     */
    public function getRentals()
    {
        return $this->rentals;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Rental\Rental> $rentals
     * @return void
     */
    public function setRentals(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $rentals)
    {
        $this->rentals = $rentals;
    }
}