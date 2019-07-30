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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * InformationController
 */
class MaintenanceController extends ActionController
{
    /**
     * @var MaintenanceRepository
     */
    protected $maintenanceRepository;

    /**
     * @param Maintenance\Car $car
     * @param \DateTimeInterface|null $issueDate
     */
    public function newAction(Maintenance\Car $car, \DateTimeInterface $issueDate = null)
    {
        $maintenance = $this->objectManager->get(Maintenance\Maintenance::class);
        $maintenance->setCar($car);
        $maintenance->setMechanic($this->getCurrentMechanic());
        $maintenance->setIssueDate($issueDate);
        // ...
    }

    /**
     * @param Maintenance\Car $car
     * @return void
     */
    public function carListAction(Maintenance\Car $car)
    {
        $this->view->assign('car', $car);
        $this->view->assign('maintenances', $this->getMaintenanceRepository()->findByCar($car));
    }

    /**
     * @return MaintenanceRepository
     */
    protected function getMaintenanceRepository(): MaintenanceRepository
    {
        return $this->maintenanceRepository
            ?? $this->maintenanceRepository = $this->objectManager->get(MaintenanceRepository::class);
    }
}
