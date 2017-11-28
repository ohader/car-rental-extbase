<?php
namespace HofUniversityIndie\CarRental\Validation\Car;

use HofUniversityIndie\CarRental\Domain\Model\Car;
use HofUniversityIndie\CarRental\Service\Car\ValidColorService;
use TYPO3\CMS\Extbase\Validation\Error;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class ColorValidator extends AbstractValidator
{
    /**
     * @var ValidColorService
     */
    private $validColorService;

    /**
     * @param ValidColorService $validColorService
     */
    public function injectValidColorService(ValidColorService $validColorService)
    {
        $this->validColorService = $validColorService;
    }

    /**
     * @param mixed|Car $value
     */
    protected function isValid($value)
    {
        if (!$value instanceof Car) {
            // validation error is added for value (e.g. the 'car' property)
            $this->addError('Not a valid car model', 1511878838);
        }

        if (!$this->validColorService->isValid($value->getColor())) {
            // validation error is added for the specific property 'car.color'
            $this->result
                ->forProperty('color')
                ->addError(new Error('Color is not allowed', 1511878839));
        }
    }
}