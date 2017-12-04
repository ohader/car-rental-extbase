<?php
namespace HofUniversityIndie\CarRental\Service\Import;

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\DataHandling\DataHandler;

class DataHandlerService
{
    /**
     * @var DataHandler
     */
    private $dataHandler;

    /**
     * @var BackendUserAuthentication
     */
    private $backendUser;

    /**
     * @var int
     */
    private $page;

    public function __construct(int $page)
    {
        $this->page = $page;
    }

    /**
     * @param DataHandler $dataHandler
     */
    public function injectDataHandler(DataHandler $dataHandler)
    {
        $this->dataHandler = $dataHandler;
    }

    /**
     * @param BackendUserAuthentication $backendUser
     */
    public function injectBackendUser(BackendUserAuthentication $backendUser)
    {
        $this->backendUser = $backendUser;
    }

    public function import(array $data)
    {
        // @todo Implement the magic
    }
}