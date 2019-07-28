<?php
namespace OliverHader\CarRentalB\Tests\Unit\Services\Car;

use OliverHader\CarRentalB\Service\Car\ValidColorService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ValidColorServiceTest extends UnitTestCase
{
    /**
     * @var ValidColorService
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new ValidColorService();
    }

    /**
     * @test
     */
    public function blackIsValid()
    {
        static::assertTrue(
            $this->subject->isValid('black')
        );
    }

    /**
     * @test
     */
    public function hex000000IsValid()
    {
        static::assertTrue(
            $this->subject->isValid('#000000')
        );
    }

    /**
     * @return array
     */
    public function colorIsValidDataProvider(): array
    {
        return [
            'black as string' => ['black'],
            'orange as string' => ['orange'],
            'red as string' => ['red'],
            'black as hex' => ['#000000'],
            'red as hex' => ['#ff0000'],
            'white as hex' => ['#ffffff'],
            'white as short hex' => ['#fff'],
        ];
    }

    /**
     * @param string $color
     *
     * @test
     * @dataProvider colorIsValidDataProvider
     */
    public function colorIsValid(string $color)
    {
        static::assertTrue(
            $this->subject->isValid($color)
        );
    }

    /**
     * @return array
     */
    public function colorIsInvalidDataProvider(): array
    {
        return [
            'invalid string color' => ['this-is-not-a-color'],
            'out of range hex' => ['#zzxxyy'],
            'out of range short hex' => ['#xyz'],
            'hex without prefix' => ['000000'],
            'empty color' => [''],
            'empty hex' => ['#'],
        ];
    }

    /**
     * @param string $color
     *
     * @test
     * @dataProvider colorIsInvalidDataProvider
     */
    public function colorIsInvalid(string $color)
    {
        static::assertFalse(
            $this->subject->isValid($color)
        );
    }
}
