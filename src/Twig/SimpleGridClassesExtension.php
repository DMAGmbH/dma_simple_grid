<?php declare(strict_types=1);

namespace Dma\SimpleGrid\Twig;

use DMA\DmaSimpleGridHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SimpleGridClassesExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'simple_grid_classes',
                [$this, 'getGridClasses'],
                ['needs_context' => true]
            )
        ];
    }

    public function getGridClasses($context): string
    {
        if (is_array($context) && isset($context['data'])) {
            return DmaSimpleGridHelper::getGridClassesForTwig($context['data']);
        }
        return '';
    }
}
