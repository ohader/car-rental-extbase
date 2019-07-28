<?php
namespace OliverHader\CarRentalB\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 */
class CarTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\CarRentalB\Domain\Model\Car
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \OliverHader\CarRentalB\Domain\Model\Car();
    }

    /**
     * @test
     */
    public function getVinReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getVin()
        );
    }

    /**
     * @test
     */
    public function setVinForStringSetsVin()
    {
        $this->subject->setVin('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'vin',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getColorReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getColor()
        );
    }

    /**
     * @test
     */
    public function setColorForStringSetsColor()
    {
        $this->subject->setColor('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'color',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForFileReferenceSetsImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImages->attach($image);
        $this->subject->setImages($objectStorageHoldingExactlyOneImages);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneImages,
            'images',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->removeImage($image);
    }

    /**
     * @test
     */
    public function getBrandReturnsInitialValueForBrand()
    {
        self::assertEquals(
            null,
            $this->subject->getBrand()
        );
    }

    /**
     * @test
     */
    public function setBrandForBrandSetsBrand()
    {
        $brandFixture = new \OliverHader\CarRentalB\Domain\Model\Brand();
        $this->subject->setBrand($brandFixture);

        self::assertAttributeEquals(
            $brandFixture,
            'brand',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTiresReturnsInitialValueForTire()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTires()
        );
    }

    /**
     * @test
     */
    public function setTiresForObjectStorageContainingTireSetsTires()
    {
        $tire = new \OliverHader\CarRentalB\Domain\Model\Tire();
        $objectStorageHoldingExactlyOneTires = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTires->attach($tire);
        $this->subject->setTires($objectStorageHoldingExactlyOneTires);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTires,
            'tires',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTireToObjectStorageHoldingTires()
    {
        $tire = new \OliverHader\CarRentalB\Domain\Model\Tire();
        $tiresObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tiresObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($tire));
        $this->inject($this->subject, 'tires', $tiresObjectStorageMock);

        $this->subject->addTire($tire);
    }

    /**
     * @test
     */
    public function removeTireFromObjectStorageHoldingTires()
    {
        $tire = new \OliverHader\CarRentalB\Domain\Model\Tire();
        $tiresObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tiresObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($tire));
        $this->inject($this->subject, 'tires', $tiresObjectStorageMock);

        $this->subject->removeTire($tire);
    }

    /**
     * @test
     */
    public function getRentalsReturnsInitialValueForRental()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getRentals()
        );
    }

    /**
     * @test
     */
    public function setRentalsForObjectStorageContainingRentalSetsRentals()
    {
        $rental = new \OliverHader\CarRentalB\Domain\Model\Rental();
        $objectStorageHoldingExactlyOneRentals = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneRentals->attach($rental);
        $this->subject->setRentals($objectStorageHoldingExactlyOneRentals);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneRentals,
            'rentals',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addRentalToObjectStorageHoldingRentals()
    {
        $rental = new \OliverHader\CarRentalB\Domain\Model\Rental();
        $rentalsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $rentalsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($rental));
        $this->inject($this->subject, 'rentals', $rentalsObjectStorageMock);

        $this->subject->addRental($rental);
    }

    /**
     * @test
     */
    public function removeRentalFromObjectStorageHoldingRentals()
    {
        $rental = new \OliverHader\CarRentalB\Domain\Model\Rental();
        $rentalsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $rentalsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($rental));
        $this->inject($this->subject, 'rentals', $rentalsObjectStorageMock);

        $this->subject->removeRental($rental);
    }
}
