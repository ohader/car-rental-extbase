<?php
namespace OliverHader\CarRentalB\Domain\Repository\Rental;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalB\Domain\Model\Rental\Car;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Rentals
 */
class RentalRepository extends Repository
{
    /**
     * @param Car $car
     * @return QueryResultInterface|Car[]
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
