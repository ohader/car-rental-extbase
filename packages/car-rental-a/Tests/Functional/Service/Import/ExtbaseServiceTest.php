<?php
namespace OliverHader\CarRentalA\Tests\Functional\Services\Import;

use OliverHader\CarRentalA\Service\Import\ExtbaseService;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class ExtbaseServiceTest extends FunctionalTestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/car_rental_a'
    ];

    protected function setUp()
    {
        // important call to parent setUp in order to build TYPO3 environment
        parent::setUp();
        // initialize backend administrator (not really require here)
        $this->setUpBackendUserFromFixture(1);
        $this->importDataSet(__DIR__ . '/../../Fixtures/pages.xml');
        Bootstrap::getInstance()->initializeLanguageObject();

        $this->objectManager = new ObjectManager();
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->objectManager);
    }

    /**
     * @test
     */
    public function csvDataCanBeImported()
    {
        $csvData = [
            [
                'brand' => 'Mercedes',
                'vin' => 'VINMERC001',
                'color' => 'orange',
                'tire-tread-depth' => '8.0',
                'tire-pressure' => '3.5',
            ]
        ];
        $subject = $this->objectManager->get(ExtbaseService::class, 1);
        $subject->import($csvData);

        $cars = $this->getAllRecords('tx_carrentala_domain_model_car');
        $brands = $this->getAllRecords('tx_carrentala_domain_model_brand');
        $tires = $this->getAllRecords('tx_carrentala_domain_model_tire');

        // assert record counts
        static::assertCount(1, $brands);
        static::assertCount(1, $cars);
        static::assertCount(4, $tires);

        // assert brand
        $this->assertRecordExists(
            ['uid' => 1, 'name' => 'Mercedes'],
            $brands
        );
        // assert car
        $this->assertRecordExists(
            ['uid' => 1, 'brand' => 1, 'vin' => 'VINMERC001', 'color' => 'orange'],
            $cars
        );
        // assert all four tires with different UID values
        $this->assertRecordExists(
            ['uid' => 1, 'car' => 1, 'tread_depth' => 8.0, 'pressure' => 3.5],
            $tires
        );
        $this->assertRecordExists(
            ['uid' => 2, 'car' => 1, 'tread_depth' => 8.0, 'pressure' => 3.5],
            $tires
        );
        $this->assertRecordExists(
            ['uid' => 3, 'car' => 1, 'tread_depth' => 8.0, 'pressure' => 3.5],
            $tires
        );
        $this->assertRecordExists(
            ['uid' => 4, 'car' => 1, 'tread_depth' => 8.0, 'pressure' => 3.5],
            $tires
        );
    }

    /**
     * @param array $expectedRecord
     * @param array $allRecords
     */
    private function assertRecordExists(array $expectedRecord, array $allRecords)
    {
        $result = $this->assertInRecords($expectedRecord, $allRecords);

        if ($result === false) {
            $hasUidField = isset($expectedRecord['uid']);
            if ($hasUidField && empty($records[$expectedRecord['uid']])) {
                $this->fail(
                    'Record "' . $expectedRecord['uid'] . '" not found in database'
                );
            }
            $recordIdentifier = $expectedRecord['uid'] ?? '';
            $additionalInformation = $hasUidField
                ? $this->renderRecords($expectedRecord, $records[$expectedRecord['uid']])
                : $this->arrayToString($expectedRecord);
            $this->fail(
                'Assertion in data-set failed for "' . $recordIdentifier . '":'
                . LF . $additionalInformation
            );
        }

        static::assertNotFalse($result);
    }
}
