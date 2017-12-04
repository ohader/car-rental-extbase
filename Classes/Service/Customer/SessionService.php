<?php
namespace HofUniversityIndie\CarRental\Service\Customer;

use HofUniversityIndie\CarRental\Domain\Model\Customer;
use HofUniversityIndie\CarRental\Domain\Repository\CustomerRepository;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class SessionService
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @param ObjectManager $objectManager
     */
    public function injectObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param CustomerRepository $customerRepository
     */
    public function injectCustomerRepository(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function provideCustomer(): Customer
    {
        $frontendUserId = $this->getFrontendUserId();

        if (empty($frontendUserId)) {
            throw new InvalidSessionException();
        }

        return $this->resolveOrCreateCustomer($frontendUserId);
    }

    private function resolveOrCreateCustomer(int $frontendUserId): Customer
    {
        $customer = $this->customerRepository->findByUser($frontendUserId);

        if (!empty($customer)) {
            return $customer;
        }

        /** @var Customer $customer */
        $customer = $this->objectManager->get(Customer::class);
        $customer->setUser($frontendUserId);

        $this->customerRepository->add($customer);
        return $customer;
    }

    /**
     * @return int|null
     */
    private function getFrontendUserId()
    {
        return $this->getFrontendController()->fe_user->user['uid'] ?? null;
    }

    /**
     * @return TypoScriptFrontendController
     */
    private function getFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}