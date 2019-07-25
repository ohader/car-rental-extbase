<?php
namespace OliverHader\CarRentalA\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class RentalTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Rental
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \OliverHader\CarRentalA\Domain\Model\Rental();
    }

    /**
     * @test
     */
    public function getStartDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getStartDate()
        );
    }

    /**
     * @test
     */
    public function setStartDateForDateTimeSetsStartDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setStartDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'startDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEndDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getEndDate()
        );
    }

    /**
     * @test
     */
    public function setEndDateForDateTimeSetsEndDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEndDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'endDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReturnDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getReturnDate()
        );
    }

    /**
     * @test
     */
    public function setReturnDateForDateTimeSetsReturnDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setReturnDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'returnDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCustomerReturnsInitialValueForCustomer()
    {
        self::assertEquals(
            null,
            $this->subject->getCustomer()
        );
    }

    /**
     * @test
     */
    public function setCustomerForCustomerSetsCustomer()
    {
        $customerFixture = new \OliverHader\CarRentalA\Domain\Model\Customer();
        $this->subject->setCustomer($customerFixture);

        self::assertAttributeEquals(
            $customerFixture,
            'customer',
            $this->subject
        );
    }
}
