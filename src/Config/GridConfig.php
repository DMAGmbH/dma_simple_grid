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

namespace Dma\DmaSimpleGrid\Config;

class GridConfig
{
    private static array $arrCache = [];

    public static function initialize(): void
    {
        if (isset(static::$arrCache['grid'])) {
            return;
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false)) {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_FALLBACK']];
        }
    }

    public static function getData($strKey): mixed
    {
        static::initialize();

        return static::$arrCache['grid']['config'][$strKey] ?? false;
    }

    public static function getDataAll(): array
    {
        static::initialize();

        return static::$arrCache['grid']['config'] ?? [];
    }
}
