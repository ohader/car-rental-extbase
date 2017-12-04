<?php
namespace HofUniversityIndie\CarRental\Service\Import;

class CsvReader
{
    /**
     * @param string $file
     * @return array
     */
    public function read(string $file): array
    {
        $data = [];

        $resource = fopen($file, 'r');
        $firstLine = fgetcsv($resource);
        while (!feof($resource)) {
            $line = fgetcsv($resource);
            if (empty($line)) {
                break;
            }
            $data[] = array_combine($firstLine, $line);
        }
        fclose($resource);

        return $data;
    }
}