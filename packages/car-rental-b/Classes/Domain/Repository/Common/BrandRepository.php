<?php
namespace OliverHader\CarRentalB\Domain\Repository\Common;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

use OliverHader\CarRentalB\Domain\Model\Common\Brand;
use TYPO3\CMS\Extbase\Persistence\Repository;

class BrandRepository extends Repository
{
    /**
     * @param string $name
     * @return Brand
     */
    public function findByName(string $name)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('name', $name)
        );
        return $query->execute()->getFirst();
    }
}
