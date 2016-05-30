<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * DMA SimpleGrid DCA
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */


$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('DMA\\DmaSimpleGridDcaCallbacks', 'adjustPalettesString');
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('DMA\\DmaSimpleGridDcaCallbacks', 'onsubmitCallback');

array_insert($GLOBALS['TL_DCA']['tl_content']['list']['operations'], 0, array(
    'show_simplegrid_infos' => array
    (
        'button_callback' => array('DMA\\DmaSimpleGrid', 'getSimpleGridInfos')
    )
));


$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_wrapper_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_wrapper_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_row_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_row_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_column_start'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['dma_simplegrid_column_stop'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';


$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_columnsettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_columnsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'columnsSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_offsetsettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_offsetsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'columnsSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_offsetrightsettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_offsetrightsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'columnsSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_pullsettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_pullsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'columnsSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_pushsettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_pushsettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'columnsSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_blocksettings'] = array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_blocksettings'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    'eval' 			=> array
    (
        'maxCount' => 1,
        'buttons' => array
        (
            'copy'=> false,
            'delete'=>false,
            'up'=>false,
            'down'=>false
        ),
        'columnsCallback' => array('DMA\\DmaSimpleGrid', 'blockSelectCallback')
    ),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalwrapperclasses'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalwrapperclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => array('DMA\\DmaSimpleGrid', 'getAdditionalWrapperClasses'),
    'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalcolumnclasses'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalcolumnclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => array('DMA\\DmaSimpleGrid', 'getAdditionalColumnClasses'),
    'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dma_simplegrid_additionalrowclasses'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['dma_simplegrid_additionalrowclasses'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => array('DMA\\DmaSimpleGrid', 'getAdditionalRowClasses'),
    'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);