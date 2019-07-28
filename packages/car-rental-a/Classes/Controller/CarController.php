<?php
namespace OliverHader\CarRentalA\Controller;

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

use OliverHader\CarRentalA\Domain\Model\Car;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * CarController
 */
class CarController extends ActionController
{
    /**
     * @var \OliverHader\CarRentalA\Domain\Repository\CarRepository
     * @Extbase\Inject
     */
    protected $carRepository = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Repository\BrandRepository
     * @Extbase\Inject
     */
    protected $brandRepository = null;

    /**
     * @var \OliverHader\CarRentalA\Domain\Repository\RentalRepository
     * @Extbase\Inject
     */
    protected $rentalRepository = null;

    /**
     * @return void
     */
    public function listAction()
    {
        $cars = $this->carRepository->findAll();
        $this->view->assign('cars', $cars);
    }

    /**
     * @param Car $car
     * @return void
     */
    public function showAction(Car $car)
    {
        $this->view->assign('car', $car);
    }

    /**
     * @param Car $car
     * @return void
     */
    public function showMaintenanceAction(Car $car)
    {
        $this->view->assign('car', $car);
    }
}
