<?php
namespace HofUniversityIndie\CarRental\Controller;

use HofUniversityIndie\CarRental\Domain\Model\Car;
use HofUniversityIndie\CarRental\Domain\Model\Customer;
use HofUniversityIndie\CarRental\Domain\Model\Rental;
use HofUniversityIndie\CarRental\Domain\Repository\CarRepository;
use HofUniversityIndie\CarRental\Domain\Repository\RentalRepository;
use HofUniversityIndie\CarRental\Service\Customer\InvalidSessionException;
use HofUniversityIndie\CarRental\Service\Customer\SessionService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class JsonController extends ActionController
{
    /**
     * @var CarRepository
     */
    private $carRepository = null;

    public function injectCarRepository(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function listAction()
    {
        $cars = $this->carRepository->findAll();
        return json_encode([]);
    }
}
