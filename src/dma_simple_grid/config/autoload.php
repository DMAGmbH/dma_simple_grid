<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'DMA',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'DMA\DmaSimpleGrid'                 => 'system/modules/dma_simple_grid/classes/DmaSimpleGrid.php',
	'DMA\DmaSimpleGridDcaCallbacks'     => 'system/modules/dma_simple_grid/classes/DmaSimpleGridDcaCallbacks.php',
	'DMA\DmaSimpleGridHelper'           => 'system/modules/dma_simple_grid/classes/DmaSimpleGridHelper.php',

	// Elements
	'DMA\ContentSimpleGridColumnStart'  => 'system/modules/dma_simple_grid/elements/ContentSimpleGridColumnStart.php',
	'DMA\ContentSimpleGridColumnStop'   => 'system/modules/dma_simple_grid/elements/ContentSimpleGridColumnStop.php',
	'DMA\ContentSimpleGridRowStart'     => 'system/modules/dma_simple_grid/elements/ContentSimpleGridRowStart.php',
	'DMA\ContentSimpleGridRowStop'      => 'system/modules/dma_simple_grid/elements/ContentSimpleGridRowStop.php',
	'DMA\ContentSimpleGridWrapperStart' => 'system/modules/dma_simple_grid/elements/ContentSimpleGridWrapperStart.php',
	'DMA\ContentSimpleGridWrapperStop'  => 'system/modules/dma_simple_grid/elements/ContentSimpleGridWrapperStop.php',

	// Forms
	'DMA\FormSimpleGridColumnStart'     => 'system/modules/dma_simple_grid/forms/FormSimpleGridColumnStart.php',
	'DMA\FormSimpleGridColumnStop'      => 'system/modules/dma_simple_grid/forms/FormSimpleGridColumnStop.php',
	'DMA\FormSimpleGridRowStart'        => 'system/modules/dma_simple_grid/forms/FormSimpleGridRowStart.php',
	'DMA\FormSimpleGridRowStop'         => 'system/modules/dma_simple_grid/forms/FormSimpleGridRowStop.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_dma_simplegrid_columnstart'   => 'system/modules/dma_simple_grid/templates/elements',
	'ce_dma_simplegrid_columnstop'    => 'system/modules/dma_simple_grid/templates/elements',
	'ce_dma_simplegrid_rowstart'      => 'system/modules/dma_simple_grid/templates/elements',
	'ce_dma_simplegrid_rowstop'       => 'system/modules/dma_simple_grid/templates/elements',
	'ce_dma_simplegrid_wrapperstart'  => 'system/modules/dma_simple_grid/templates/elements',
	'ce_dma_simplegrid_wrapperstop'   => 'system/modules/dma_simple_grid/templates/elements',
	'form_dma_simplegrid_columnstart' => 'system/modules/dma_simple_grid/templates/forms',
	'form_dma_simplegrid_columnstop'  => 'system/modules/dma_simple_grid/templates/forms',
	'form_dma_simplegrid_rowstart'    => 'system/modules/dma_simple_grid/templates/forms',
	'form_dma_simplegrid_rowstop'     => 'system/modules/dma_simple_grid/templates/forms',
));
