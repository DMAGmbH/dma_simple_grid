<?php

declare(strict_types=1);

/*
 * This file is part of Dma Simple Grid.
 *
 * (c) Janosch Oltmanns 2023 <kontakt@janosch-oltmanns.de>
 * @license LGPL-3.0+
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/DMAGmbH/dma_simple_grid
 */

namespace Dma\DmaSimpleGrid\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Dma\DmaSimpleGrid\Config\GridConfig;

class Settings
{
    #[AsCallback(table: 'tl_settings', target: 'config.onload')]
    public function adjustSettingsPalettesString(): void
    {
        $fieldsToAppend = [];
        $fieldsToAppend[] = 'dmaSimpleGridType';

        if (GridConfig::getData('hasColumns')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useColumns';
        }

        if (GridConfig::getData('hasColumnOffset')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useOffset';
        }

        if (GridConfig::getData('hasColumnOffsetRight')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useOffsetRight';
        }

        if (GridConfig::getData('hasColumnPush')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_usePush';
        }

        if (GridConfig::getData('hasColumnPull')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_usePull';
        }

        if (GridConfig::getData('hasBlockGrid')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useBlockGrid';
        }

        if (GridConfig::getData('hasWrapperClasses')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useAdditionalWrapperClasses';
        }

        if (GridConfig::getData('hasRowClasses')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useAdditionalRowClasses';
        }

        if (GridConfig::getData('hasColumnClasses')) {
            $fieldsToAppend[] = 'dmaSimpleGrid_useAdditionalColumnClasses';
        }

        $fieldsToAppend[] = 'dmaSimpleGrid_useOwnSettingsByIncludeElements';

        PaletteManipulator::create()
            ->addLegend('dma_simplegrid_legend', null, PaletteManipulator::POSITION_APPEND)
            ->addField($fieldsToAppend, 'dma_simplegrid_legend', PaletteManipulator::POSITION_APPEND)
            ->applyToPalette('default', 'tl_settings')
        ;
    }

    #[AsCallback(table: 'tl_settings', target: 'fields.dmaSimpleGridType.options')]
    public function getGridTypes(): array
    {
        $arrGridTypes = [];

        foreach ($GLOBALS['DMA_SIMPLEGRID_CONFIG'] as $keyValue => $arrGridConfig) {
            $arrGridTypes[$keyValue] = $arrGridConfig['name'];
        }

        return $arrGridTypes;
    }
}
