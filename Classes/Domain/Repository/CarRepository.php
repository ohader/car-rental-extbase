<?php
namespace HofUniversityIndie\CarRental\Domain\Repository;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use HofUniversityIndie\CarRental\Domain\Model\Brand;
use HofUniversityIndie\CarRental\Domain\Model\Car;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * The repository for Cars
 */
class CarRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param Brand $brand
     * @return QueryResultInterface|Car[]
     */
    public function findByBrand(Brand $brand)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('brand', $brand)
        );
        return $query->execute();
    }
}
