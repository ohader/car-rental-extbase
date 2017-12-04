<?php
namespace HofUniversityIndie\CarRental\Controller;

use HofUniversityIndie\CarRental\Domain\Model\Car;
use HofUniversityIndie\CarRental\Domain\Model\Rental;
use HofUniversityIndie\CarRental\Domain\Repository\RentalRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;

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

    protected function initializeAction()
    {
        parent::initializeAction();

        // adjust date format for rental.startDate & rental.endDate to 'Y-m-d'
        if ($this->arguments->hasArgument('rental')) {
            $rental = $this->arguments->getArgument('rental');
            foreach (['startDate', 'endDate'] as $propertyName) {
                $rental->getPropertyMappingConfiguration()
                    ->forProperty($propertyName)
                    ->setTypeConverterOption(
                        DateTimeConverter::class,
                        DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                        'Y-m-d'
                    );
            }
        }
    }

    public function listAction()
    {
    }

    /**
     * @param Car $car
     * @param Rental|null $rental
     */
    public function newAction(Car $car, Rental $rental = null)
    {
        if ($rental === null) {
            /** @var Rental $rental */
            $rental = $this->objectManager->get(Rental::class);
            $rental->setStartDate($this->createDate(1));
            $rental->setEndDate($this->createDate(8));
        }

        $this->view->assignMultiple([
            'car' => $car,
            'rental' => $rental,
        ]);
    }

    /**
     * @param Car $car
     * @param Rental $rental
     * @validate $rental \HofUniversityIndie\CarRental\Validation\Rental\DatesValidator
     */
    public function createAction(Car $car, Rental $rental)
    {
    }

    public function deleteAction()
    {
    }

    private function createDate(int $addDays = 0): \DateTime
    {
        $date = new \DateTime('now');
        $date->setTime(0, 0, 0);
        if ($addDays > 0) {
            $date->add(
                new \DateInterval(
                    sprintf('P%dD', $addDays)
                )
            );
        }
        return $date;
    }
}
