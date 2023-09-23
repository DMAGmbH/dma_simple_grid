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

use Contao\ArrayUtil;
use Dma\DmaSimpleGrid\DataContainer\AcrossTablesDcaCallbacks;
use Dma\DmaSimpleGrid\DataContainer\DcaUtil;

/**
 * Operations
 */
ArrayUtil::arrayInsert($GLOBALS['TL_DCA']['tl_form_field']['list']['operations'], 0, [
    'show_simplegrid_infos' => [],
]);

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_row_start'] = '{type_legend},type;{expert_legend:hide},class;{template_legend:hide},customTpl';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_row_stop'] = '{type_legend},type;{template_legend:hide},customTpl';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_column_start'] = '{type_legend},type;{expert_legend:hide},class;{template_legend:hide},customTpl';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_column_stop'] = '{type_legend},type;{template_legend:hide},customTpl';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_columnsettings'] = [
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'maxCount'        => 1,
        'buttons'         => [
            'up'     => false,
            'down'   => false,
            'move'   => false,
            'new'    => false,
            'copy'   => false,
            'delete' => false,
        ],
        'columnsCallback' => [AcrossTablesDcaCallbacks::class, 'columnsSelectCallback'],
    ],
    'sql'       => "text NULL",
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_offsetsettings'] = [
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'maxCount'        => 1,
        'buttons'         => [
            'up'     => false,
            'down'   => false,
            'move'   => false,
            'new'    => false,
            'copy'   => false,
            'delete' => false,
        ],
        'columnsCallback' => [AcrossTablesDcaCallbacks::class, 'columnsSelectCallback'],
    ],
    'sql'       => "text NULL",
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_pullsettings'] = [
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'maxCount'        => 1,
        'buttons'         => [
            'up'     => false,
            'down'   => false,
            'move'   => false,
            'new'    => false,
            'copy'   => false,
            'delete' => false,
        ],
        'columnsCallback' => [AcrossTablesDcaCallbacks::class, 'columnsSelectCallback'],
    ],
    'sql'       => "text NULL",
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_pushsettings'] = [
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'maxCount'        => 1,
        'buttons'         => [
            'up'     => false,
            'down'   => false,
            'move'   => false,
            'new'    => false,
            'copy'   => false,
            'delete' => false,
        ],
        'columnsCallback' => [AcrossTablesDcaCallbacks::class, 'columnsSelectCallback'],
    ],
    'sql'       => "text NULL",
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_additionalrowclasses'] = [
    'exclude'          => true,
    'inputType'        => 'checkbox',
    'eval'             => ['multiple' => true],
    'sql'              => "blob NULL",
];
