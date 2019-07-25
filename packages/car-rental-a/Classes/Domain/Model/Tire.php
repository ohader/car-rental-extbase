<?php
namespace HofUniversityIndie\CarRental\Domain\Model;

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
 * Tire
 */
class Tire extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Tread Depth
     *
     * @var float
     * @validate NotEmpty
     */
    protected $treadDepth = 0.0;

    /**
     * Pressure (bar)
     *
     * @var float
     * @validate NotEmpty
     */
    protected $pressure = 0.0;

    /**
     * Returns the treadDepth
     *
     * @return float $treadDepth
     */
    public function getTreadDepth()
    {
        return $this->treadDepth;
    }

    /**
     * Sets the treadDepth
     *
     * @param float $treadDepth
     * @return void
     */
    public function setTreadDepth($treadDepth)
    {
        $this->treadDepth = $treadDepth;
    }

    /**
     * Returns the pressure
     *
     * @return float $pressure
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Sets the pressure
     *
     * @param float $pressure
     * @return void
     */
    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }
}
