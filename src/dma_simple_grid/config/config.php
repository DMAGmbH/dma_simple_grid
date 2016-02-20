<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * DMA SimpleGrid configuration
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */


/**
 * Content elements
 */

$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_start'] = 'DMA\\ContentSimpleGridRowStart';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_stop'] = 'DMA\\ContentSimpleGridRowStop';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_start'] = 'DMA\\ContentSimpleGridColumnStart';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_stop'] = 'DMA\\ContentSimpleGridColumnStop';


/**
 * Front end wrappers
 */

$GLOBALS['TL_WRAPPERS']['start'][] = 'dma_simplegrid_row_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'dma_simplegrid_row_stop';
$GLOBALS['TL_WRAPPERS']['start'][] = 'dma_simplegrid_column_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'dma_simplegrid_column_stop';



/**
 * Front end form fields
 */

$GLOBALS['TL_FFL']['dma_simplegrid_row_start'] = 'DMA\\FormSimpleGridRowStart';
$GLOBALS['TL_FFL']['dma_simplegrid_row_stop'] = 'DMA\\FormSimpleGridRowStop';
$GLOBALS['TL_FFL']['dma_simplegrid_column_start'] = 'DMA\\FormSimpleGridColumnStart';
$GLOBALS['TL_FFL']['dma_simplegrid_column_stop'] = 'DMA\\FormSimpleGridColumnStop';


/*
 *
 * Hooks
 *
 */

$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('DMA\\DmaSimpleGridHelper', 'simplegridParseTemplate');
$GLOBALS['TL_HOOKS']['loadFormField'][] = array('DMA\\DmaSimpleGridHelper', 'simplegridLoadFormField');


/*
 * Grid definitions
 *
 */

$GLOBALS['DMA_SIMPLEGRID_CONFIG'] = array();

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['contao'] = array
(
    'name' => 'Contao Grid',
    'config' => array
    (
        'hasRows' => false,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => false,
        'hasColumnPull' => false,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'columns-sizes' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'columns-config' => array
        (
            '*' => array
            (
                'name' => 'grid',
                'column-class' => 'grid%d',
                'offset-class' => 'offset%d'
            )
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['bootstrap'] = array
(
    'name' => 'Bootstrap',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'columns-config' => array
        (
            'xs' => array
            (
                'name' => 'extra small',
                'column-class' => 'col-xs-%d',
                'offset-class' => 'col-xs-offset-%d',
                'push-class' => 'col-xs-push-%d',
                'pull-class' => 'col-xs-pull-%d'
            ),
            'sm' => array
            (
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'col-sm-offset-%d',
                'push-class' => 'col-sm-push-%d',
                'pull-class' => 'col-sm-pull-%d'
            ),
            'md' => array
            (
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'col-md-offset-%d',
                'push-class' => 'col-md-push-%d',
                'pull-class' => 'col-md-pull-%d'
            ),
            'lg' => array
            (
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'col-lg-offset-%d',
                'push-class' => 'col-lg-push-%d',
                'pull-class' => 'col-lg-pull-%d'
            )
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['bootstrap4'] = array
(
    'name' => 'Bootstrap 4',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'columns-config' => array
        (
            'xs' => array
            (
                'name' => 'extra small',
                'column-class' => 'col-xs-%d',
                'offset-class' => 'col-xs-offset-%d',
                'push-class' => 'col-xs-push-%d',
                'pull-class' => 'col-xs-pull-%d'
            ),
            'sm' => array
            (
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'col-sm-offset-%d',
                'push-class' => 'col-sm-push-%d',
                'pull-class' => 'col-sm-pull-%d'
            ),
            'md' => array
            (
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'col-md-offset-%d',
                'push-class' => 'col-md-push-%d',
                'pull-class' => 'col-md-pull-%d'
            ),
            'lg' => array
            (
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'col-lg-offset-%d',
                'push-class' => 'col-lg-push-%d',
                'pull-class' => 'col-lg-pull-%d'
            ),
            'xl' => array
            (
                'name' => 'extra large',
                'column-class' => 'col-xl-%d',
                'offset-class' => 'col-xl-offset-%d',
                'push-class' => 'col-xl-push-%d',
                'pull-class' => 'col-xl-pull-%d'
            )
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['gr-grid'] = array
(
    'name' => 'Bootstrap 4 (with GRgrid)',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' => array
        (
            'golden ratio' => array
            (
                'gr24','gr29','gr38','gr47','gr53','gr62','gr71','gr76'
            ),
            'default columns' => array
            (
                '1','2','3','4','5','6','7','8','9','10','11','12'
            )
        ),
        'columns-config' => array
        (
            'xs' => array
            (
                'name' => 'extra small',
                'column-class' => 'col-xs-%d',
                'offset-class' => 'col-xs-offset-%d',
                'push-class' => 'col-xs-push-%d',
                'pull-class' => 'col-xs-pull-%d'
            ),
            'sm' => array
            (
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'col-sm-offset-%d',
                'push-class' => 'col-sm-push-%d',
                'pull-class' => 'col-sm-pull-%d'
            ),
            'md' => array
            (
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'col-md-offset-%d',
                'push-class' => 'col-md-push-%d',
                'pull-class' => 'col-md-pull-%d'
            ),
            'lg' => array
            (
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'col-lg-offset-%d',
                'push-class' => 'col-lg-push-%d',
                'pull-class' => 'col-lg-pull-%d'
            ),
            'xl' => array
            (
                'name' => 'extra large',
                'column-class' => 'col-xl-%d',
                'offset-class' => 'col-xl-offset-%d',
                'push-class' => 'col-xl-push-%d',
                'pull-class' => 'col-xl-pull-%d'
            )
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['foundation'] = array
(
    'name' => 'Foundation',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'row',
        'column-class' => 'columns',
        'columns-sizes' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'columns-config' => array
        (
            'small' => array
            (
                'name' => 'small',
                'column-class' => 'small-%d',
                'offset-class' => 'small-offset-%d',
                'push-class' => 'small-push-%d',
                'pull-class' => 'small-pull-%d'
            ),
            'medium' => array
            (
                'name' => 'medium',
                'column-class' => 'medium-%d',
                'offset-class' => 'medium-offset-%d',
                'push-class' => 'medium-push-%d',
                'pull-class' => 'medium-pull-%d'
            ),
            'large' => array
            (
                'name' => 'large',
                'column-class' => 'large-%d',
                'offset-class' => 'large-offset-%d',
                'push-class' => 'large-push-%d',
                'pull-class' => 'large-pull-%d'
            )
        ),
        'additional-classes' => array
        (
            'row' => array('expanded','column','small-uncollapse','medium-uncollapse','large-uncollapse','small-collapse','medium-collapse','large-collapse'),
            'columns' => array('end','small-centered','medium-centered','large-centered','small-uncentered','medium-uncentered','large-uncentered')
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['delos'] = array
(
    'name' => 'DELOS',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' => array('3','4','6','8','9','12'),
        'columns-config' => array
        (
            'small' => array
            (
                'name' => 'small',
                'column-class' => 'col-small-%d',
                'offset-class' => 'offset-small-%d',
                'push-class' => 'push-small-%d',
                'pull-class' => 'pull-small-%d'
            ),
            'medium' => array
            (
                'name' => 'medium',
                'column-class' => 'col-medium-%d',
                'offset-class' => 'offset-medium-%d',
                'push-class' => 'push-medium-%d',
                'pull-class' => 'pull-medium-%d'
            ),
            'large' => array
            (
                'name' => 'large',
                'column-class' => 'col-large-%d',
                'offset-class' => 'offset-large-%d',
                'push-class' => 'push-large-%d',
                'pull-class' => 'pull-large-%d'
            )
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['unsemantic'] = array
(
    'name' => 'unsemantic',
    'config' => array
    (
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => true,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'grid-container',
        'columns-sizes' => array('5','10','15','20','25','30','33','35','40','45','50','55','60','65','66','70','75','80','85','90','95','100'),
        'columns-config' => array
        (
            'mobile' => array
            (
                'name' => 'mobile',
                'column-class' => 'mobile-grid-%d',
                'offset-class' => 'mobile-prefix-%d',
                'offset-right-class' => 'mobile-suffix-%d',
                'push-class' => 'mobile-push-%d',
                'pull-class' => 'mobile-pull-%d'
            ),
            'tablet' => array
            (
                'name' => 'tablet',
                'column-class' => 'tablet-grid-%d',
                'offset-class' => 'tablet-prefix-%d',
                'offset-right-class' => 'tablet-suffix-%d',
                'push-class' => 'tablet-push-%d',
                'pull-class' => 'tablet-pull-%d'
            ),
            'desktop' => array
            (
                'name' => 'desktop',
                'column-class' => 'grid-%d',
                'offset-class' => 'prefix-%d',
                'offset-right-class' => 'suffix-%d',
                'push-class' => 'push-%d',
                'pull-class' => 'pull-%d'
            )
        ),
        'additional-classes' => array
        (
            'row' => array('grid-offset'),
            'columns' => array('grid-parent','grid-offset')
        )
    )
);

$GLOBALS['DMA_SIMPLEGRID_FALLBACK'] = 'delos';