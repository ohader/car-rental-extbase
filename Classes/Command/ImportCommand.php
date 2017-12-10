<?php
namespace HofUniversityIndie\CarRental\Command;

use HofUniversityIndie\CarRental\Service\Import\CsvReader;
use HofUniversityIndie\CarRental\Service\Import\DataHandlerService;
use HofUniversityIndie\CarRental\Service\Import\ExtbaseService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/***
 * This file is part of the "Car Rental" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

class ImportCommand extends Command
{
    protected function configure()
    {
        $this
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

        $this->getConfigurationManager()->setConfiguration([
            'extensionName' => 'CarRental'
        ]);
        $this->createExtbaseService($page)->import(
            $reader->read($file)
        );
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
     * @return ExtbaseService
     */
    private function createExtbaseService(int $page): ExtbaseService
    {
        return $this->getObjectManager()->get(ExtbaseService::class, $page);
    }

    /**
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
     * @return ConfigurationManager
     */
    private function getConfigurationManager(): ConfigurationManager
    {
        return $this->getObjectManager()->get(ConfigurationManager::class);
    }

    /**
     * @return object|ObjectManager
     */
    private function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }
}
