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
use OliverHader\CarRentalB\Domain\Model\Maintenance\Maintenance;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Maintenances
 */
class MaintenanceRepository extends Repository
{
    /**
     * @param Car $car
     * @return QueryResultInterface|Maintenance[]
     */
    public function findByCar(Car $car)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('car', $car)
        );
        return $query->execute();
    }
}
