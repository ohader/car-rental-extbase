<?php
namespace OliverHader\CarRentalB\Domain\Model\Maintenance;

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
     * @var \OliverHader\CarRentalB\Domain\Model\Common\Brand
     * @Extbase\ORM\Lazy
     */
    protected $brand = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Tire>
     * @Extbase\ORM\Cascade("remove")
     */
    protected $tires = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance>
     * @Extbase\ORM\Cascade("remove")
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
        $this->tires = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->maintenances = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * @param \OliverHader\CarRentalB\Domain\Model\Maintenance\Tire $tire
     * @return void
     */
    public function addTire(\OliverHader\CarRentalB\Domain\Model\Maintenance\Tire $tire)
    {
        $this->tires->attach($tire);
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Maintenance\Tire $tire
     * @return void
     */
    public function removeTire(\OliverHader\CarRentalB\Domain\Model\Maintenance\Tire $tire)
    {
        $this->tires->detach($tire);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Tire>
     */
    public function getTires()
    {
        return $this->tires;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Tire> $tires
     * @return void
     */
    public function setTires(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tires)
    {
        $this->tires = $tires;
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance $maintenance
     * @return void
     */
    public function addMaintenance(\OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance $maintenance)
    {
        $this->maintenances->attach($maintenance);
    }

    /**
     * @param \OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance $maintenance
     * @return void
     */
    public function removeMaintenance(\OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance $maintenance)
    {
        $this->maintenances->detach($maintenance);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance>
     */
    public function getMaintenances()
    {
        return $this->maintenances;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance> $maintenances
     * @return void
     */
    public function setMaintenances(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $maintenances)
    {
        $this->maintenances = $maintenances;
    }
}
