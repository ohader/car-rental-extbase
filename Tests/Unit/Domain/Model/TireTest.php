<?php
namespace HofUniversityIndie\CarRental\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class TireTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \HofUniversityIndie\CarRental\Domain\Model\Tire
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \HofUniversityIndie\CarRental\Domain\Model\Tire();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTreadDepthReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getTreadDepth()
        );
    }

    /**
     * @test
     */
    public function setTreadDepthForFloatSetsTreadDepth()
    {
        $this->subject->setTreadDepth(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'treadDepth',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getPressureReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getPressure()
        );
    }

    /**
     * @test
     */
    public function setPressureForFloatSetsPressure()
    {
        $this->subject->setPressure(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'pressure',
            $this->subject,
            '',
            0.000000001
        );
    }
}
