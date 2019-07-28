<?php
namespace OliverHader\CarRentalB\Domain\Repository;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalB\Domain\Model\Customer;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class CustomerRepository extends Repository
{
    /**
     * @param int $user
     * @return Customer
     */
    public function findByUser(int $user)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('user', $user)
        );
        return $query->execute()->getFirst();
    }
}
