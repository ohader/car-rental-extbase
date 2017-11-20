<?php
namespace HofUniversityIndie\CarRental\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class CustomerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \HofUniversityIndie\CarRental\Domain\Model\Customer
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \HofUniversityIndie\CarRental\Domain\Model\Customer();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getUser()
        );
    }

    /**
     * @test
     */
    public function setUserForIntSetsUser()
    {
        $this->subject->setUser(12);

        self::assertAttributeEquals(
            12,
            'user',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFirstNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameForStringSetsFirstName()
    {
        $this->subject->setFirstName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLastNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameForStringSetsLastName()
    {
        $this->subject->setLastName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastName',
            $this->subject
        );
    }
}
