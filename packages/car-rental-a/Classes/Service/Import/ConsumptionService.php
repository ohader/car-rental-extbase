<?php
namespace OliverHader\CarRentalA\Service\Import;

class ConsumptionService
{
    /**
     * @var float
     */
    private $microtimeStart;

    /**
     * @var float
     */
    private $microtimeEnd;

    /**
     * @var int
     */
    private $memoryStart;

    /**
     * @var int
     */
    private $memoryEnd;

    /**
     * @return array
     */
    public function getDifference(): array
    {
        return [
            'microtime' => $this->microtimeEnd - $this->microtimeStart,
            'memory' => $this->memoryEnd - $this->memoryStart,
        ];
    }

    public function start()
    {
        $this->memoryStart = memory_get_usage();
        $this->microtimeStart = microtime(true);
    }

    public function stop()
    {
        $this->microtimeEnd = microtime(true);
        $this->memoryEnd = memory_get_usage();
    }
}