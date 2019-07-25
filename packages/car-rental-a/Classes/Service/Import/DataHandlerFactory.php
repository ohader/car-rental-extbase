<?php
namespace HofUniversityIndie\CarRental\Service\Import;

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class DataHandlerFactory
{
    /**
     * @var BackendUserAuthentication
     */
    private $backendUser;

    public function __construct(BackendUserAuthentication $backendUser = null)
    {
        if ($backendUser === null) {
            $backendUser = $GLOBALS['BE_USER'];
        }
        $this->backendUser = $backendUser;
    }

    /**
     * @param array $dataMap
     * @return DataHandler
     */
    public function createForDataMap(array $dataMap): DataHandler
    {
        /** @var DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($dataMap, [], $this->backendUser);
        return $dataHandler;
    }
}