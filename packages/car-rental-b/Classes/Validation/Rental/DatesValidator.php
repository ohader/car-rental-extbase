<?php
namespace OliverHader\CarRentalB\Validation\Rental;

use OliverHader\CarRentalB\Domain\Model\Rental;
use TYPO3\CMS\Extbase\Validation\Error;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class DatesValidator extends AbstractValidator
{
    /**
     * @param mixed|Rental $value
     */
    protected function isValid($value)
    {
        if (!$value instanceof Rental) {
            // validation error is added for value (e.g. the 'car' property)
            $this->addError('Not a valid rental model', 1512402026);
        }

        if (!$this->isValidDate($value->getStartDate())) {
            $this->result
                ->forProperty('startDate')
                ->addError(new Error('Must be valid date', 1512402027));
        }
        if (!$this->isValidDate($value->getEndDate())) {
            $this->result
                ->forProperty('startDate')
                ->addError(new Error('Must be valid date', 1512402027));
        }
        if ($value->getStartDate() >= $value->getEndDate()) {
            $this->result
                ->forProperty('endDate')
                ->addError(new Error('Must be after start date', 1512402028));
        }
    }

    private function isValidDate($value)
    {
        return $value instanceof \DateTimeInterface
            && $value > new \DateTimeImmutable('now');
    }
}