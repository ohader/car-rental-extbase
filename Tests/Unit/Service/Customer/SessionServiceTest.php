<?php
namespace HofUniversityIndie\CarRental\Tests\Unit\Services\Customer;

use HofUniversityIndie\CarRental\Domain\Model\Customer;
use HofUniversityIndie\CarRental\Domain\Repository\CustomerRepository;
use HofUniversityIndie\CarRental\Service\Customer\InvalidSessionException;
use HofUniversityIndie\CarRental\Service\Customer\SessionService;
use PHPUnit\Framework\MockObject\MockObject;
use Prophecy\Prophecy\ObjectProphecy;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class SessionServiceTest extends UnitTestCase
{
    /**
     * @var SessionService|MockObject
     */
    protected $subject = null;

    /**
     * @var TypoScriptFrontendController
     */
    protected $frontendUserProphecy;

    protected function setUp()
    {
        $this->subject = $this->getMockBuilder(SessionService::class)
            ->setMethods(['getFrontendController'])
            ->getMock();
    }

    /**
     * @test
     */
    public function provideCustomerFailsWhenNoUserIsLoggedIn()
    {
        $this->subject->expects(static::once())
            ->method('getFrontendController')
            ->willReturn($this->createFrontendUser(null));

        $this->expectException(InvalidSessionException::class);
        $this->expectExceptionCode(1512943193);

        $this->subject->provideCustomer();
    }

    /**
     * @test
     */
    public function provideCustomerProvidesNewCustomerEntity()
    {
        $this->subject->expects(static::once())
            ->method('getFrontendController')
            ->willReturn($this->createFrontendUser(13));

        $customer = $this->prophesize(Customer::class);
        $customer->setUser(13)
            ->shouldBeCalled();

        $objectManager = $this->prophesize(ObjectManager::class);
        $objectManager->get(Customer::class)->willReturn($customer->reveal());

        $customerRepository = $this->prophesize(CustomerRepository::class);
        $customerRepository->findByUser(13)
            ->shouldBeCalled()
            ->willReturn(null);
        $customerRepository->add($customer->reveal())
            ->shouldBeCalled();

        $this->subject->injectObjectManager($objectManager->reveal());
        $this->subject->injectCustomerRepository($customerRepository->reveal());

        static::assertSame(
            $customer->reveal(),
            $this->subject->provideCustomer()
        );
    }

    /**
     * @test
     */
    public function provideCustomerProvidesExistingCustomerEntity()
    {
        $this->subject->expects(static::once())
            ->method('getFrontendController')
            ->willReturn($this->createFrontendUser(13));

        $customer = $this->prophesize(Customer::class);

        $objectManager = $this->prophesize(ObjectManager::class);
        $objectManager->get(Customer::class)->willReturn($customer->reveal());

        $customerRepository = $this->prophesize(CustomerRepository::class);
        $customerRepository->findByUser(13)
            ->shouldBeCalled()
            ->willReturn($customer->reveal());

        $this->subject->injectObjectManager($objectManager->reveal());
        $this->subject->injectCustomerRepository($customerRepository->reveal());

        static::assertSame(
            $customer->reveal(),
            $this->subject->provideCustomer()
        );
    }

    /**
     * @param int|null $id
     * @return object|TypoScriptFrontendController|ObjectProphecy
     */
    private function createFrontendUser(int $id = null)
    {
        $frontendController = $this->prophesize(TypoScriptFrontendController::class);
        $frontendUser = $this->prophesize(FrontendUserAuthentication::class);
        $frontendController->fe_user = $frontendUser->reveal();

        if ($id === null) {
            $frontendUser->user = null;
        } else {
            $frontendUser->user = ['uid' => $id];
        }

        return $frontendController->reveal();
    }
}
