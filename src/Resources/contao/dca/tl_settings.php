<?php


use DMA\DmaSimpleGridDcaCallbacks;
use DMA\DmaSimpleGridHelper;

$GLOBALS['TL_DCA']['tl_settings']['config']['onload_callback'][] = [DmaSimpleGridDcaCallbacks::class, 'adjustSettingsPalettesString'];

/**
 * Add to palette
 *
 * Done via DmaSimpleGridDcaCallbacks::adjustSettingsPalettesString()
 */



/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGridType'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGridType'],
    'inputType'	        => 'select',
    'options_callback'  => [DmaSimpleGridHelper::class, 'getGridTypes'],
    'eval'		        => ['tl_class'=>'w50', 'submitOnChange'=>true, 'includeBlankOption'=>true]
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useColumns'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useColumns'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50 clr']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffset'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useOffset'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffsetRight'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useOffsetRight'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePush'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_usePush'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePull'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_usePull'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useBlockGrid'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useBlockGrid'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalWrapperClasses'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalWrapperClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalRowClasses'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalRowClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50 clr']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalColumnClasses'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalColumnClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOwnSettingsByIncludeElements'] = [
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useOwnSettingsByIncludeElements'],
    'inputType'	        => 'checkbox',
    'eval'		        => ['tl_class'=>'w50 clr']
];
