<?php declare(strict_types=1);

namespace Dma\SimpleGrid\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Dma\SimpleGrid\SimpleGridBundle;
use Contao\ManagerBundle\ContaoManagerBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(SimpleGridBundle::class)
                ->setLoadAfter(
                    [
                        ContaoCoreBundle::class,
                        ContaoManagerBundle::class,
                    ]
                )
                ->setReplace(
                [
                    'dma_simple_grid',
                ]
            ),
        ];
    }
}
