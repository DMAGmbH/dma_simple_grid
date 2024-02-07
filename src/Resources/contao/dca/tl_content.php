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

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = [DmaSimpleGridDcaCallbacks::class, 'adjustPalettesString'];
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = [DmaSimpleGridDcaCallbacks::class, 'onsubmitCallback'];

ArrayUtil::arrayInsert($GLOBALS['TL_DCA']['tl_content']['list']['operations'], 0, [
    'show_simplegrid_infos' => [
        'button_callback' => [DmaSimpleGrid::class, 'getSimpleGridInfos']
    ]
]);


$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_wrapper_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_wrapper_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_row_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_row_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_column_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_column_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';


$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_columnsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_columnsettings'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_offsetsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_offsetsettings'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_offsetrightsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_offsetrightsettings'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_pullsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_pullsettings'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_pushsettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_pushsettings'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_blocksettings'] = [
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_blocksettings'],
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
        'columnsCallback' => [DmaSimpleGrid::class, 'blockSelectCallback']
    ],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalwrapperclasses'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalwrapperclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => [DmaSimpleGrid::class, 'getAdditionalWrapperClasses'],
    'eval'                    => ['multiple'=>true],
    'sql'                     => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalcolumnclasses'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalcolumnclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => [DmaSimpleGrid::class, 'getAdditionalColumnClasses'],
    'eval'                    => ['multiple'=>true],
    'sql'                     => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalrowclasses'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalrowclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => [DmaSimpleGrid::class, 'getAdditionalRowClasses'],
    'eval'                    => ['multiple'=>true],
    'sql'                     => "blob NULL"
];
