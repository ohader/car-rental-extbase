<?php
namespace HofUniversityIndie\CarRental\ViewHelpers\Widget;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class ColorViewHelper extends AbstractViewHelper
{
    /**
     * @var string[]
     */
    private $knowColors = [
        'black',
        'orange',
        'green',
        'red',
    ];

    /**
     * Don't escape output since it's clean HTML already.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param string|null $color
     * @return string
     */
    public function render(string $color = null): string
    {
        if ($color === null) {
            $color = $this->renderChildren();
        }

        if (
            in_array($color, $this->knowColors, true)
            || preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/', $color)
        ) {
            $styles = [
                'background-color' => $color,
            ];
        } else {
            // @todo Better but that to some static CSS class - just for demo
            $styles = [
                'background-color' => '#fff',
                'background-size' => '50px 50px',
                'background-position' => '0 0, 25px 25px',
                'background-image' =>
                    'linear-gradient(45deg, grey 25%, transparent 25%, transparent 75%, grey 75%, grey),'
                    . 'linear-gradient(45deg, grey 25%, transparent 25%, transparent 75%, grey 75%, grey)'
            ];
        }

        $styles['width'] = '200px';
        $styles['height'] = '200px';
        $styles['display'] = 'inline-block';

        return sprintf(
            '<div style="%s"></div>',
            $this->compileStyles($styles)
        );
    }

    /**
     * @param array $styles
     * @return string
     */
    private function compileStyles(array $styles): string
    {
        $styleDefinitions = [];
        foreach ($styles as $propertyName => $propertyValue) {
            $styleDefinitions[] = $propertyName . ':' . $propertyValue;
        }
        return implode(';', $styleDefinitions);
    }
}