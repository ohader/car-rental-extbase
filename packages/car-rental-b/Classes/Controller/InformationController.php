<?php
namespace OliverHader\CarRentalB\Controller;

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

use OliverHader\CarRentalB\Domain\Model\Rental;
use OliverHader\CarRentalB\Domain\Model\Maintenance;
use OliverHader\CarRentalB\Domain\Repository\Maintenance\MaintenanceRepository;
use OliverHader\CarRentalB\Domain\Repository\Rental\CarRepository;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * InformationController
 */
class InformationController extends ActionController
{
    /**
     * @var CarRepository
     */
    protected $carRepository;

    /**
     * @return void
     */
    public function carListAction()
    {
        $cars = $this->getCarRepository()->findAll();
        $this->view->assign('cars', $cars);
    }

    /**
     * @param Rental\Car $car
     */
    public function carDetailAction(Rental\Car $car)
    {
        $this->view->assign('car', $car);
    }

    /**
     * @param Maintenance\Car $car
     * @return void
     */
    public function showMaintenanceAction(Maintenance\Car $car)
    {
        $this->view->assign('car', $car);
        $this->view->assign('maintenances', $this->getMaintenanceRepository()->findByCar($car));
    }

    /**
     * @return CarRepository
     */
    protected function getCarRepository(): CarRepository
    {
        return $this->carRepository
            ?? $this->carRepository = $this->objectManager->get(CarRepository::class);
    }

    /**
     * @return MaintenanceRepository
     */
    protected function getMaintenanceRepository(): MaintenanceRepository
    {
        return $this->objectManager->get(MaintenanceRepository::class);
    }
}
