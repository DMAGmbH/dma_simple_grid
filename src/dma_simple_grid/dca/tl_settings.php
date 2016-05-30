<?php



$GLOBALS['TL_DCA']['tl_settings']['config']['onload_callback'][] = array('DMA\\DmaSimpleGridDcaCallbacks', 'adjustSettingsPalettesString');

/**
 * Add to palette
 */
// Done via DmaSimpleGridDcaCallbacks->adjustSettingsPalettesString


/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGridType'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGridType'],
    'inputType'	        => 'select',
    'options_callback'  => array('DMA\\DmaSimpleGridHelper', 'getGridTypes'),
    'eval'		        => array('tl_class'=>'w50', 'submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useColumns'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useColumns'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffset'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useOffset'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useOffsetRight'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useOffsetRight'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePush'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_usePush'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_usePull'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_usePull'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useBlockGrid'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useBlockGrid'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalWrapperClasses'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalWrapperClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalRowClasses'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalRowClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGrid_useAdditionalColumnClasses'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGrid_useAdditionalColumnClasses'],
    'inputType'	        => 'checkbox',
    'eval'		        => array('tl_class'=>'w50')
);
