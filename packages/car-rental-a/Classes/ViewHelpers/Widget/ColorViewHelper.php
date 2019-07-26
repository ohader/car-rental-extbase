<?php
namespace OliverHader\CarRentalA\ViewHelpers\Widget;

use OliverHader\CarRentalA\Service\Car\ValidColorService;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ColorViewHelper extends AbstractViewHelper
{
    /**
     * @var ValidColorService
     */
    private $validColorService;

    /**
     * Don't escape output since it's clean HTML already.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param ValidColorService $validColorService
     */
    public function injectValidColorService(ValidColorService $validColorService)
    {
        $this->validColorService = $validColorService;
    }

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('color', 'string', false, 'Color to be used in CSS');
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $color = $this->arguments['color'] ?? null;

        if ($color === null) {
            $color = $this->renderChildren();
        }

        if ($this->validColorService->isValid($color)) {
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