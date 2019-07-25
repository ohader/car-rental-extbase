<?php
namespace OliverHader\CarRentalA\Domain\Repository;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalA\Domain\Model\Customer;
use OliverHader\CarRentalA\Domain\Model\Rental;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class RentalRepository extends Repository
{
    /**
     * @param Customer $customer
     * @return QueryResultInterface|Rental[]
     */
    public function findByCustomer(Customer $customer)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('customer', $customer)
        );
        return $query->execute();
    }
}
