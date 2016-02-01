<?php


/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{dma_simplegrid_legend},dmaSimpleGridType,dmaSimpleGrid_useColumns,dmaSimpleGrid_useOffset,dmaSimpleGrid_usePush,dmaSimpleGrid_usePull,dmaSimpleGrid_useAdditionalRowClasses,dmaSimpleGrid_useAdditionalColumnClasses';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmaSimpleGridType'] = array
(
    'label'		        => &$GLOBALS['TL_LANG']['tl_settings']['dmaSimpleGridType'],
    'inputType'	        => 'select',
    'options_callback'  => array('DMA\\DmaSimpleGrid', 'getGridTypes'),
    'eval'		        => array('tl_class'=>'w50')
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
