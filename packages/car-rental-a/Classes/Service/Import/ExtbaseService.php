<?php
namespace OliverHader\CarRentalA\Service\Import;

use OliverHader\CarRentalA\Domain\Model\Brand;
use OliverHader\CarRentalA\Domain\Model\Car;
use OliverHader\CarRentalA\Domain\Model\Tire;
use OliverHader\CarRentalA\Domain\Repository\BrandRepository;
use OliverHader\CarRentalA\Domain\Repository\CarRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class ExtbaseService
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * @var PersistenceManager
     */
    private $persistenceManager;

    /**
     * @var Brand[]
     */
    private $brands = [];

    /**
     * @var int
     */
    private $page;

    public function __construct(int $page)
    {
        $this->page = $page;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function injectObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param CarRepository $carRepository
     */
    public function injectCarRepository(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param BrandRepository $brandRepository
     */
    public function injectBrandRepository(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param PersistenceManager $persistenceManager
     */
    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    public function import(array $data)
    {
        // @todo Mapping instruction should be external
        foreach ($data as $item) {
            $brand = $this->provideBrand($item['brand']);

            /** @var Car $car */
            $car = $this->objectManager->get(Car::class);
            $car->setPid($this->page);
            $car->setBrand($brand);
            $car->setVin($item['vin']);
            $car->setColor($item['color']);
            for ($i = 0; $i < 4; $i++) {
                $car->addTire($this->createTire(
                    $item['tire-tread-depth'],
                    $item['tire-pressure'])
                );
            }

            $this->carRepository->add($car);
        }

        $this->persistenceManager->persistAll();
    }

    private function createTire(float $treadDepth, float $pressure): Tire
    {
        /** @var Tire $tire */
        $tire = $this->objectManager->get(Tire::class);
        $tire->setPid($this->page);
        $tire->setTreadDepth($treadDepth);
        $tire->setPressure($pressure);
        return $tire;
    }

    private function provideBrand(string $name): Brand
    {
        if (isset($this->brands[$name])) {
            return $this->brands[$name];
        }

        $brand = $this->brandRepository->findByName($name);
        if ($brand === null) {
            /** @var Brand $brand */
            $brand = $this->objectManager->get(Brand::class);
            $brand->setPid($this->page);
            $brand->setName($name);
        }

        $this->brands[$name] = $brand;
        return $brand;
    }
}