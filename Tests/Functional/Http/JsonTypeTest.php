<?php
namespace HofUniversityIndie\CarRental\Tests\Functional\Http;

use PHPUnit\Util\PHP\AbstractPhpProcess;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\Response;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class JsonTypeTest extends FunctionalTestCase
{
    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/car_rental'
    ];

    protected function setUp()
    {
        // important call to parent setUp in order to build TYPO3 environment
        parent::setUp();
        $this->importDataSet(__DIR__ . '/../Fixtures/pages.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/brands.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/cars.xml');
        $this->importDataSet(__DIR__ . '/../Fixtures/tires.xml');

        // sets a TYPO3 root page & loads basic TypoScript rendering instruction
        $this->setUpFrontendRootPage(
            1,
            ['EXT:car_rental/Tests/Functional/Http/Fixtures/JsonType.typoscript']
        );
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->subject);
    }

    /**
     * @test
     */
    public function jsonIsReturned()
    {
        $expected = [
            ['vin' => 'VIN', 'color' => 'COLOR', 'brand' => 'Special Brand', 'images' => []],
        ];

        $contentResponse = $this->executeHttpFrontendRequest();
        $actual = json_decode($contentResponse, true);
        static::assertSame($expected, $actual);
    }

    /**
     * Execute frontend request using the scenario of this functional test.
     *
     * @return mixed
     */
    private function executeHttpFrontendRequest()
    {
        $arguments = [
            'documentRoot' => $this->instancePath,
            // type=1513077042 is configured in TypoScript to invoke JsonController
            'requestUrl' => 'http://localhost/?id=1&type=1513077042',
        ];

        $template = new \Text_Template(
            TYPO3_PATH_PACKAGES . 'typo3/testing-framework/Resources/Core/Functional/Fixtures/Frontend/request.tpl'
        );
        $template->setVar([
            'arguments' => var_export($arguments, true),
            'originalRoot' => ORIGINAL_ROOT,
            'vendorPath' => TYPO3_PATH_PACKAGES
        ]);

        $php = AbstractPhpProcess::factory();
        $response = $php->runJob($template->render());
        $result = json_decode($response['stdout'], true);

        if ($result === null) {
            $this->fail('Frontend Response is empty');
        }

        if ($result['status'] === Response::STATUS_Failure) {
            $this->fail('Frontend Response has failure:' . LF . $result['error']);
        }

        return $result['content'];
    }
}