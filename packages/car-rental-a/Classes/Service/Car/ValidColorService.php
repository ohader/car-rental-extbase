<?php
namespace HofUniversityIndie\CarRental\Service\Car;

class ValidColorService
{
    /**
     * @var string[]
     */
    private $allowedColors = [
        'black',
        'orange',
        'green',
        'blue',
        'purple',
        'red',
    ];

    /**
     * @param string|null $color
     * @return bool
     */
    public function isValid(string $color = null): bool
    {
        return (
            $this->isAllowed($color)
            || $this->isHexadecimal($color)
        );
    }

    /**
     * @param string|null $color
     * @return bool
     */
    public function isAllowed(string $color = null): bool
    {
        if (empty($color)) {
            return false;
        }
        return in_array($color, $this->allowedColors, true);
    }

    /**
     * @param string|null $color
     * @return bool
     */
    public function isHexadecimal(string $color = null): bool
    {
        if (empty($color)) {
            return false;
        }
        return preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/', $color);
    }
}