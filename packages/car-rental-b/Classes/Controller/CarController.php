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
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * CarController
 */
class CarController extends ActionController
{
    /**
     * @var \OliverHader\CarRentalB\Domain\Repository\Rental\CarRepository
     * @Extbase\Inject
     */
    protected $carRepository = null;

    /**
     * @return void
     */
    public function listAction()
    {
        $cars = $this->carRepository->findAll();
        $this->view->assign('cars', $cars);
    }

    /**
     * @param Rental\Car $car
     * @return void
     */
    public function showAction(Rental\Car $car)
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
    }
}
