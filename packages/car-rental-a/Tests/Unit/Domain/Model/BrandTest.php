<?php
namespace OliverHader\CarRentalA\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class BrandTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\CarRentalA\Domain\Model\Brand
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \OliverHader\CarRentalA\Domain\Model\Brand();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }
}
