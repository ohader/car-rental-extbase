<?php
namespace OliverHader\CarRentalB\Command;

use OliverHader\CarRentalB\Service\Import\ConsumptionService;
use OliverHader\CarRentalB\Service\Import\CsvReader;
use OliverHader\CarRentalB\Service\Import\DataHandlerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class DataHandlerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Imports CSV data using TYPO3 DataHandler')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'CSV File name to be imported'
            )
            ->addArgument(
                'page',
                InputArgument::REQUIRED,
                'Target page id'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $page = $input->getArgument('page');

        $this->verifyFile($file);

        $reader = $this->createCsvReader();
        $consumption = new ConsumptionService();
        $consumption->start();

        // faking backend user admin permissions
        // (in CLI context not real backend user is logged in)
        $this->getBackendUser()->user['uid'] = 0;
        $this->getBackendUser()->user['admin'] = 1;
        $this->getBackendUser()->workspace = 0;
        $this->createDataHandlerService($page)->import(
            $reader->read($file)
        );

        $consumption->stop();
        foreach ($consumption->getDifference() as $aspect => $value) {
            $output->writeln(
                sprintf('Consumption "%s": %.02f', $aspect, $value)
            );
        }
    }

    /**
     * @param string $file
     */
    private function verifyFile(string $file)
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(
                sprintf('File "%s" not found', $file),
                1512417926
            );
        }

        $fileInfo = new \finfo();
        $mimeType = $fileInfo->file($file, FILEINFO_MIME_TYPE);

        if (!empty($mimeType) && $mimeType !== 'text/csv' && $mimeType !== 'text/plain') {
            throw new \RuntimeException(
                sprintf('Expected "text/csv", got "%s" mime-type', $mimeType),
                1512417927
            );
        }
    }

    /**
     * @param int $page
     * @return DataHandlerService
     */
    private function createDataHandlerService(int $page): DataHandlerService
    {
        return $this->getObjectManager()->get(DataHandlerService::class, $page);
    }

    /**
     * @return object|CsvReader
     */
    private function createCsvReader(): CsvReader
    {
        return GeneralUtility::makeInstance(CsvReader::class);
    }

    /**
     * @return object|ObjectManager
     */
    private function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * @return BackendUserAuthentication
     */
    private function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
