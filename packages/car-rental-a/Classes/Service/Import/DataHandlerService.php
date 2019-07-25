<?php
namespace HofUniversityIndie\CarRental\Service\Import;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\StringUtility;

class DataHandlerService
{
    const TABLE_NAME_BRAND = 'tx_carrental_domain_model_brand';
    const TABLE_NAME_CAR = 'tx_carrental_domain_model_car';
    const TABLE_NAME_TIRE = 'tx_carrental_domain_model_tire';

    /**
     * @var DataHandlerFactory
     */
    private $dataHandlerFactory;

    /**
     * @var ConnectionPool
     */
    private $connectionPool;

    /**
     * @var array[]
     */
    private $brands;

    /**
     * @var int
     */
    private $page;

    public function __construct(int $page)
    {
        $this->page = $page;
    }

    /**
     * @param DataHandlerFactory $dataHandlerFactory
     */
    public function injectDataHandlerFactory(DataHandlerFactory $dataHandlerFactory)
    {
        $this->dataHandlerFactory = $dataHandlerFactory;
    }

    public function injectConnectionPool(ConnectionPool $connectionPool)
    {
        $this->connectionPool = $connectionPool;
    }

    public function import(array $data)
    {
        $dataMap = [];

        foreach ($data as $item) {
            $this->importCar($dataMap, $item);
        }

        $dataHandler = $this->dataHandlerFactory->createForDataMap($dataMap);
        $dataHandler->process_datamap();

        foreach ($dataHandler->substNEWwithIDs_table[static::TABLE_NAME_BRAND] ?? [] as $newBrandId) {
            // replacing the 'NEW' indicators for brand records with real record ids
            $this->brands[$newBrandId] = $dataHandler->substNEWwithIDs[$newBrandId];
        }
    }

    private function importCar(array &$dataMap, array $item)
    {
        // the 'NEW' prefix is used as indicator for DateHandler
        $carId = StringUtility::getUniqueId('NEW');
        $dataMap[static::TABLE_NAME_CAR][$carId] = [
            // pid value has to be provided for new records only
            'pid' => $this->page,
            'vin' => $item['vin'],
            'color' => $item['color'],
            'brand' => $this->provideBrand(
                $dataMap,
                $item['brand']
            ),
            'tires' => $this->provideTires(
                $dataMap,
                $item['tire-tread-depth'],
                $item['tire-pressure']
            ),
        ];
    }

    private function provideBrand(array &$dataMap, string $name)
    {
        if (!isset($this->brands)) {
            // making use of the Doctrine DBAL query builder
            // to retrieve all brand records from database
            $queryBuilder = $this->connectionPool
                ->getQueryBuilderForTable(static::TABLE_NAME_BRAND);
            $statement = $queryBuilder
                ->select('uid', 'name')
                ->from(static::TABLE_NAME_BRAND)
                ->execute();

            $this->brands = [];
            foreach ($statement->fetchAll() as $record) {
                // in case brand names are duplicated in database
                // this will only resolve the last brand records
                $this->brands[$record['name']] = $record['uid'];
            }
        }
        if (!isset($this->brands[$name])) {
            // the 'NEW' prefix is used as indicator for DateHandler
            $brandId = StringUtility::getUniqueId('NEW');
            $this->brands[$name] = $brandId;
            // modify $dataMap reference to create new brand record
            $dataMap[static::TABLE_NAME_BRAND][$brandId] = [
                // pid value has to be provided for new records only
                'pid' => $this->page,
                'name' => $name,
            ];
        }
        return $this->brands[$name];
    }

    private function provideTires(array &$dataMap, string $treadDepth, string $pressure): string
    {
        $tireIds = [];
        for ($i = 0; $i < 4; $i++) {
            $tireIds[] = $this->provideTire($dataMap, $treadDepth, $pressure);
        }
        return implode(',', $tireIds);
    }

    private function provideTire(array &$dataMap, string $treadDepth, string $pressure): string
    {
        // the 'NEW' prefix is used as indicator for DateHandler
        $tireId = StringUtility::getUniqueId('NEW');
        // modify $dataMap reference to create new brand record
        $dataMap[static::TABLE_NAME_TIRE][$tireId] = [
            // pid value has to be provided for new records only
            'pid' => $this->page,
            'tread_depth' => $treadDepth,
            'pressure' => $pressure,
        ];
        return $tireId;
    }
}