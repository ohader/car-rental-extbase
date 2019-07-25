<?php
namespace OliverHader\CarRentalA\Controller;

use OliverHader\CarRentalA\Domain\Model\Car;
use OliverHader\CarRentalA\Domain\Repository\CarRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class JsonController extends ActionController
{
    /**
     * @var CarRepository
     */
    private $carRepository = null;

    /**
     * @var JsonView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = JsonView::class;

    public function injectCarRepository(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function listAction()
    {
        $cars = $this->carRepository->findAll();

        $this->view->setVariablesToRender(['cars']);
        $this->view->assign(
            'cars',
            $this->getCarsJsonRepresentation($cars->toArray())
        );
    }

    /**
     * @param Car[] $cars
     * @return array
     */
    private function getCarsJsonRepresentation(array $cars): array
    {
        return array_map(
            function (Car $car) {
                return [
                    'vin' => $car->getVin(),
                    'color' => $car->getColor(),
                    'brand' => $car->getBrand()->getName(),
                    'images' => $this->getImagesJsonRepresentation(
                        $car->getImages()->toArray()
                    ),
                ];
            },
            $cars
        );
    }

    private function getImagesJsonRepresentation(array $images): array
    {
        $webPath = $this->resolveWebPath();
        return array_map(
            function (FileReference $fileReference) use ($webPath) {
                return $webPath . $fileReference
                    ->getOriginalResource()
                    ->getPublicUrl();
            },
            $images
        );
    }

    /**
     * Resolves web path prefix
     * (e.g. if http://site.com/path/index.php is called /path/ is returned)
     *
     * @return string
     */
    private function resolveWebPath(): string
    {
        return GeneralUtility::getIndpEnv('TYPO3_SITE_PATH');
    }
}
