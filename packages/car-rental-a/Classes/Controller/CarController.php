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
     * @return void
     */
    public function listAction()
    {
        $cars = $this->carRepository->findAll();
        $this->view->assign('cars', $cars);
    }

    /**
     * @param \OliverHader\CarRentalA\Domain\Model\Car $car
     * @return void
     */
    public function showAction(\OliverHader\CarRentalA\Domain\Model\Car $car)
    {
        $this->view->assign('car', $car);
    }
}
