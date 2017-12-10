<?php
namespace HofUniversityIndie\CarRental\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class CarControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \HofUniversityIndie\CarRental\Controller\CarController
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = $this->getMockBuilder(\HofUniversityIndie\CarRental\Controller\CarController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function listActionFetchesAllCarsFromRepositoryAndAssignsThemToView()
    {

        $allCars = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $carRepository = $this->getMockBuilder(\HofUniversityIndie\CarRental\Domain\Repository\CarRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $carRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCars));
        $this->inject($this->subject, 'carRepository', $carRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('cars', $allCars);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCarToView()
    {
        $car = new \HofUniversityIndie\CarRental\Domain\Model\Car();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('car', $car);

        $this->subject->showAction($car);
    }
}
