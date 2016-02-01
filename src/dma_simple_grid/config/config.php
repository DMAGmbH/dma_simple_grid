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


$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_start'] = 'DMA\\ContentSimpleGridRowStart';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_stop'] = 'DMA\\ContentSimpleGridRowStop';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_start'] = 'DMA\\ContentSimpleGridColumnStart';
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_stop'] = 'DMA\\ContentSimpleGridColumnStop';

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
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('DMA\\DmaSimpleGrid', 'simplegridParseTemplate');
$GLOBALS['TL_HOOKS']['loadFormField'][] = array('DMA\\DmaSimpleGrid', 'simplegridLoadFormField');


/*
 * FOUNDATION
 *
 * small
 * medium
 * large
 *
 * row
 * columns + small-# || medium-# || large-#
 *
 *
 * BOOTSTRAP
 *
 * extra small
 * small
 * medium
 * large
 *
 * row
 * col-xs-# || col-sm-# || col-md-# || col-lg-#
 *
 */



$GLOBALS['DMA_SIMPLEGRID_CONFIG'] = array
(
    'bootstrap' => array
    (
        'name' => 'Bootstrap',
        'config' => array
        (
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
    ),
    'bootstrap4' => array
    (
        'name' => 'Bootstrap 4',
        'config' => array
        (
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
    ),
    'gr-grid' => array
    (
        'name' => 'Bootstrap 4 (with GRgrid)',
        'config' => array
        (
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
    ),
    'foundation' => array
    (
        'name' => 'Foundation',
        'config' => array
        (
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
                'row' => array('expanded'),
                'columns' => array
                (
                    'end' => 'end',
                    'small-centered' => 'small-centered',
                    'medium-centered' => 'medium-centered',
                    'large-centered' => 'large-centered'
                )
            )
        )
    ),
    'delos' => array
    (
        'name' => 'DELOS',
        'config' => array
        (
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
    )
);

$GLOBALS['DMA_SIMPLEGRID_FALLBACK'] = 'delos';