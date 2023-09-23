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

use Dma\DmaSimpleGrid\DataContainer\AcrossTablesDcaCallbacks;
use Dma\DmaSimpleGridHelper;

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGridType'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGridType'],
    'inputType' => 'select',
    //'options_callback' => Registered via php 8 attributes,
    'eval'      => ['tl_class' => 'w50', 'submitOnChange' => true, 'includeBlankOption' => true],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useColumns'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 clr'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffset'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffsetRight'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePush'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePull'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useBlockGrid'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalWrapperClasses'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalRowClasses'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 clr'],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalColumnClasses'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
];
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOwnSettingsByIncludeElements'] = [
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 clr'],
];
