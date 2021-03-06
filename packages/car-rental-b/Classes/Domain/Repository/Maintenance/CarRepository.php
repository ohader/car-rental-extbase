<?php
namespace OliverHader\CarRentalB\Domain\Repository\Maintenance;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalB\Domain\Model\Common\Brand;
use OliverHader\CarRentalB\Domain\Model\Maintenance\Car;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Cars
 */
class CarRepository extends Repository
{
    /**
     * @param string $vin
     * @return QueryResultInterface|\OliverHader\CarRentalB\Domain\Model\Rental\Car[]
     */
    public function findByVin(string $vin)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('vin', $vin)
        );
        return $query->execute();
    }

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
