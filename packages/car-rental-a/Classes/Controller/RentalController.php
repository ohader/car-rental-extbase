<?php
namespace OliverHader\CarRentalA\Controller;

use OliverHader\CarRentalA\Domain\Model\Car;
use OliverHader\CarRentalA\Domain\Model\Customer;
use OliverHader\CarRentalA\Domain\Model\Rental;
use OliverHader\CarRentalA\Domain\Repository\RentalRepository;
use OliverHader\CarRentalA\Service\Customer\InvalidSessionException;
use OliverHader\CarRentalA\Service\Customer\SessionService;
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
     * @var SessionService
     */
    private $sessionService;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @param RentalRepository $rentalRepository
     */
    public function injectRentalRepository(RentalRepository $rentalRepository)
    {
        $this->rentalRepository = $rentalRepository;
    }

    /**
     * @param SessionService $sessionService
     */
    public function injectSessionService(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    protected function initializeAction()
    {
        parent::initializeAction();

        try {
            $this->customer = $this->sessionService->provideCustomer();
        } catch (InvalidSessionException $exception)
        {
            $this->redirect('notLoggedInError');
        }

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
        $rentals = $this->rentalRepository->findByCustomer($this->customer);
        $this->view->assign('rentals', $rentals);
        $this->view->assign('today', $this->createDate());
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
     * @validate $rental \OliverHader\CarRentalA\Validation\Rental\DatesValidator
     */
    public function createAction(Car $car, Rental $rental)
    {
        $rental->setCar($car);
        $rental->setCustomer($this->customer);
        $this->rentalRepository->add($rental);
        $this->redirect('list');
    }

    /**
     * @param Rental $rental
     */
    public function deleteAction(Rental $rental)
    {
        $this->verifyRentalCustomer($rental);

        if ($rental->getStartDate() > $this->createDate()) {
            $this->rentalRepository->remove($rental);
        }
        $this->redirect('list');
    }

    public function notLoggedInErrorAction()
    {
    }

    /**
     * Verifies current customer in rental object to be modified.
     *
     * @param Rental $rental
     */
    private function verifyRentalCustomer(Rental $rental)
    {
        $customer = $rental->getCustomer();

        if (!empty($customer) && $customer->getUid() !== $this->customer->getUid()) {
            $this->redirect('permissionError');
        }
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
