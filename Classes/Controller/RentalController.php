<?php
namespace HofUniversityIndie\CarRental\Controller;

use HofUniversityIndie\CarRental\Domain\Model\Car;
use HofUniversityIndie\CarRental\Domain\Repository\RentalRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class RentalController extends ActionController
{
    /**
     * @var RentalRepository
     */
    private $rentalRepository;

    /**
     * @param RentalRepository $rentalRepository
     */
    public function injectRentalRepository(RentalRepository $rentalRepository)
    {
        $this->rentalRepository = $rentalRepository;
    }

    public function listAction()
    {
    }

    public function newAction()
    {
    }

    public function createAction()
    {
    }

    public function deleteAction()
    {
    }
}
