<?php
namespace OliverHader\CarRentalB\Tests\Functional\Domain\Repository;

use OliverHader\CarRentalB\Domain\Model\Brand;
use OliverHader\CarRentalB\Domain\Repository\BrandRepository;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class ExtbaseServiceTest extends FunctionalTestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/car_rental_b'
    ];

    protected function setUp()
    {
        // important call to parent setUp in order to build TYPO3 environment
        parent::setUp();
        $this->importDataSet(__DIR__ . '/../../Fixtures/pages.xml');
        $this->importDataSet(__DIR__ . '/../../Fixtures/brands.xml');

        // define storage page ID (pages.uid on which cars are stored in test)
        // (explicitly defining TypoScript settings here - not loaded automatically)
        ExtensionManagementUtility::addTypoScriptSetup(
            'config.tx_extbase.persistence.storagePid = 1'
        );

        $this->objectManager = new ObjectManager();
        $this->brandRepository = $this->objectManager->get(BrandRepository::class);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->objectManager);
        unset($this->brandRepository);
    }

    /**
     * @test
     */
    public function brandEntityIsFoundByName()
    {
        $brand = $this->brandRepository->findByName('Special Brand');

        static::assertInstanceOf(Brand::class, $brand);
        static::assertSame('Special Brand', $brand->getName());
    }
}
