<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Contao\ArrayUtil;
use DMA\DmaSimpleGridDcaCallbacks;
use DMA\DmaSimpleGrid;

/**
 * DMA SimpleGrid DCA
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */

$GLOBALS['TL_DCA']['tl_form_field']['config']['onload_callback'][] = [DmaSimpleGridDcaCallbacks::class, 'adjustPalettesString'];
$GLOBALS['TL_DCA']['tl_form_field']['config']['onsubmit_callback'][] = [DmaSimpleGridDcaCallbacks::class, 'onsubmitCallbackFormField'];

ArrayUtil::arrayInsert($GLOBALS['TL_DCA']['tl_form_field']['list']['operations'], 0, [
    'show_simplegrid_infos' => [
        'button_callback' => [DmaSimpleGrid::class, 'getSimpleGridInfos']
    ]
]);



$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_row_start'] = '{type_legend},type;{expert_legend:hide},class;{template_legend:hide},customTpl';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_row_stop'] = '{type_legend},type;{template_legend:hide},customTpl';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_column_start'] = '{type_legend},type;{expert_legend:hide},class;{template_legend:hide},customTpl';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['dma_simplegrid_column_stop'] = '{type_legend},type;{template_legend:hide},customTpl';



$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_columnsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['dma_simplegrid_columnsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> [
        'maxCount' => 1,
        'buttons' => [
            'up' => false,
            'down' => false,
            'move' => false,
            'new' => false,
            'copy' => false,
            'delete' => false,
        ],
        'columnsCallback' => [DmaSimpleGrid::class, 'columnsSelectCallback']
    ],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_offsetsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['dma_simplegrid_offsetsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> [
        'maxCount' => 1,
        'buttons' => [
            'up' => false,
            'down' => false,
            'move' => false,
            'new' => false,
            'copy' => false,
            'delete' => false,
        ],
        'columnsCallback' => [DmaSimpleGrid::class, 'columnsSelectCallback']
    ],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_pullsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['dma_simplegrid_pullsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> [
        'maxCount' => 1,
        'buttons' => [
            'up' => false,
            'down' => false,
            'move' => false,
            'new' => false,
            'copy' => false,
            'delete' => false,
        ],
        'columnsCallback' => [DmaSimpleGrid::class, 'columnsSelectCallback']
    ],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_pushsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_form_field']['dma_simplegrid_pushsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> [
        'maxCount' => 1,
        'buttons' => [
            'up' => false,
            'down' => false,
            'move' => false,
            'new' => false,
            'copy' => false,
            'delete' => false,
        ],
        'columnsCallback' => [DmaSimpleGrid::class, 'columnsSelectCallback']
    ],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['dma_simplegrid_additionalrowclasses'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['dma_simplegrid_additionalrowclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => [DmaSimpleGrid::class, 'getAdditionalRowClasses'],
    'eval'                    => ['multiple'=>true],
    'sql'                     => "blob NULL"
];
