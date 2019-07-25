<?php
namespace OliverHader\CarRentalA\Controller;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalA\Domain\Model\Brand;
use OliverHader\CarRentalA\Domain\Model\Car;
use OliverHader\CarRentalA\Domain\Repository\BrandRepository;
use OliverHader\CarRentalA\Domain\Repository\CarRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class ManagementController extends ActionController
{
    /**
     * @var CarRepository
     */
    protected $carRepository;

    /**
     * @var BrandRepository
     */
    protected $brandRepository;

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

    protected function addErrorFlashMessage()
    {
        // in case validation errors have been found for the `updateAction`
        // skip adding a dedicated flash message since validation errors
        // are directly shown in the Management/PropertiesForm partial
        if (
            $this->arguments->getValidationResults()->hasErrors()
            && $this->actionMethodName === 'updateAction'
        ) {
            return;
        }
        parent::addErrorFlashMessage();
    }

    /**
     * @param Brand $selectedBrand
     * @return void
     */
    public function listAction(Brand $selectedBrand = null)
    {
        $brands = $this->brandRepository->findAll();

        if ($selectedBrand === null) {
            $cars = $this->carRepository->findAll();
        } else {
            $cars = $this->carRepository->findByBrand($selectedBrand);
        }

        $this->view->assign('selectedBrand', $selectedBrand);
        $this->view->assign('brands', $brands);
        $this->view->assign('cars', $cars);
    }

    /**
     * @param Car $car
     * @return void
     */
    public function showAction(Car $car)
    {
        $this->view->assign('car', $car);
    }

    /**
     * @param Car $car
     */
    public function editAction(Car $car)
    {
        $brands = $this->brandRepository->findAll();
        $this->view->assign('brands', $brands);
        $this->view->assign('car', $car);
    }

    /**
     * @param Car $car
     * @validate $car \OliverHader\CarRentalA\Validation\Car\ColorValidator
     */
    public function updateAction(Car $car)
    {
        $this->carRepository->update($car);
        $this->addFlashMessage(
            LocalizationUtility::translate(
                'ManagementController.carUpdated',
                $this->extensionName
            )
        );
        $this->registerCacheUpdate();
        $this->redirect('status');
    }

    public function deleteAction(Car $car)
    {
        $this->carRepository->remove($car);
        $this->addFlashMessage(
            LocalizationUtility::translate(
                'ManagementController.carUpdated',
                $this->extensionName
            )
        );
        $this->registerCacheUpdate();
        $this->redirect('status');
    }

    public function statusAction()
    {
    }

    /**
     * Registers cache update for current frontend page id.
     *
     * Alternative:
     * In TYPO3 Backend in Page TSconfig define
     * `TCEMAIN.clearCacheCmd = <frontend page id>`
     * in storage folder of car records
     */
    private function registerCacheUpdate()
    {
        $this->cacheService->getPageIdStack()->push(
            $this->getFrontendController()->id
        );
    }

    /**
     * @return TypoScriptFrontendController
     */
    private function getFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}
