<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use DMA\DmaSimpleGridHelper;
use DMA\FormSimpleGridColumnStop;
use DMA\FormSimpleGridColumnStart;
use DMA\FormSimpleGridRowStop;
use DMA\FormSimpleGridRowStart;
use DMA\ContentSimpleGridColumnStop;
use DMA\ContentSimpleGridColumnStart;
use DMA\ContentSimpleGridRowStop;
use DMA\ContentSimpleGridRowStart;
use DMA\ContentSimpleGridWrapperStop;
use DMA\ContentSimpleGridWrapperStart;

/**
 * DMA SimpleGrid configuration
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */


/**
 * Content elements
 */

$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_start'] = ContentSimpleGridWrapperStart::class;
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_stop'] = ContentSimpleGridWrapperStop::class;
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_start'] = ContentSimpleGridRowStart::class;
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_stop'] = ContentSimpleGridRowStop::class;
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_start'] = ContentSimpleGridColumnStart::class;
$GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_column_stop'] = ContentSimpleGridColumnStop::class;


/**
 * Front end wrappers
 */

$GLOBALS['TL_WRAPPERS']['start'][] = 'dma_simplegrid_wrapper_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'dma_simplegrid_wrapper_stop';
$GLOBALS['TL_WRAPPERS']['start'][] = 'dma_simplegrid_row_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'dma_simplegrid_row_stop';
$GLOBALS['TL_WRAPPERS']['start'][] = 'dma_simplegrid_column_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'dma_simplegrid_column_stop';



/**
 * Front end form fields
 */

$GLOBALS['TL_FFL']['dma_simplegrid_row_start'] = FormSimpleGridRowStart::class;
$GLOBALS['TL_FFL']['dma_simplegrid_row_stop'] = FormSimpleGridRowStop::class;
$GLOBALS['TL_FFL']['dma_simplegrid_column_start'] = FormSimpleGridColumnStart::class;
$GLOBALS['TL_FFL']['dma_simplegrid_column_stop'] = FormSimpleGridColumnStop::class;


/*
 *
 * Hooks
 *
 */

$GLOBALS['TL_HOOKS']['parseTemplate'][] = [DmaSimpleGridHelper::class, 'simplegridParseTemplate'];
$GLOBALS['TL_HOOKS']['loadFormField'][] = [DmaSimpleGridHelper::class, 'simplegridLoadFormField'];


/*
 * Grid definitions
 *
 */

$GLOBALS['DMA_SIMPLEGRID_CONFIG'] = [];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['contao'] =
    [
    'name' => 'Contao Grid',
    'config' =>
        [
        'hasRows' => false,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => false,
        'hasColumnPull' => false,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'columns-config' =>
            [
            '*' =>
                [
                'name' => 'grid',
                'column-class' => 'grid%d',
                'offset-class' => 'offset%d'
                ]
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['bootstrap'] =
    [
    'name' => 'Bootstrap',
    'config' =>
        [
        'hasWrapper' => true,
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetReset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPushReset' => true,
        'hasColumnPull' => true,
        'hasColumnPullReset' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'wrapper-class' => 'container',
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'columns-config' =>
            [
            'xs' =>
                [
                'name' => 'extra small',
                'column-class' => 'col-xs-%d',
                'offset-class' => 'col-xs-offset-%d',
                'push-class' => 'col-xs-push-%d',
                'pull-class' => 'col-xs-pull-%d',
                'hide-class' => 'hidden-xs',
                ],
            'sm' =>
                [
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'col-sm-offset-%d',
                'push-class' => 'col-sm-push-%d',
                'pull-class' => 'col-sm-pull-%d',
                'hide-class' => 'hidden-sm',
                ],
            'md' =>
                [
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'col-md-offset-%d',
                'push-class' => 'col-md-push-%d',
                'pull-class' => 'col-md-pull-%d',
                'hide-class' => 'hidden-md',
                ],
            'lg' =>
                [
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'col-lg-offset-%d',
                'push-class' => 'col-lg-push-%d',
                'pull-class' => 'col-lg-pull-%d',
                'hide-class' => 'hidden-lg',
                ]
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['bootstrap4'] =
    [
    'name' => 'Bootstrap 4 (alpha)',
    'config' =>
        [
        'hasWrapper' => true,
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetReset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPushReset' => true,
        'hasColumnPull' => true,
        'hasColumnPullReset' => true,
        'hasWrapperClasses' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'wrapper-class' => '',
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'columns-config' =>
            [
            'xs' =>
                [
                'name' => 'extra small',
                'column-class' => 'col-%d',
                'offset-class' => 'offset-%d',
                'push-class' => 'push-%d',
                'pull-class' => 'pull-%d',
                'hide-class' => 'd-xs-none',
                ],
            'sm' =>
                [
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'offset-sm-%d',
                'push-class' => 'push-sm-%d',
                'pull-class' => 'pull-sm-%d',
                'hide-class' => 'd-sm-none',
                ],
            'md' =>
                [
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'offset-md-%d',
                'push-class' => 'push-md-%d',
                'pull-class' => 'pull-md-%d',
                'hide-class' => 'd-md-none',
                ],
            'lg' =>
                [
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'offset-lg-%d',
                'push-class' => 'push-lg-%d',
                'pull-class' => 'pull-lg-%d',
                'hide-class' => 'd-lg-none',
                ],
            'xl' =>
                [
                'name' => 'extra large',
                'column-class' => 'col-xl-%d',
                'offset-class' => 'offset-xl-%d',
                'push-class' => 'push-xl-%d',
                'pull-class' => 'pull-xl-%d',
                'hide-class' => 'd-xl-none',
                ]
            ],
        'additional-classes' =>
            [
            'wrapper' => ['container', 'container-fluid']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['gr-grid'] =
    [
    'name' => 'Bootstrap 4 (with GRgrid)',
    'config' =>
        [
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetReset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPushReset' => true,
        'hasColumnPull' => true,
        'hasColumnPullReset' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' =>
            [
            'golden ratio' =>
                [
                'gr24','gr29','gr38','gr47','gr53','gr62','gr71','gr76'
                ],
            'default columns' =>
                [
                '1','2','3','4','5','6','7','8','9','10','11','12'
                ]
            ],
        'columns-config' =>
            [
            'xs' =>
                [
                'name' => 'extra small',
                'column-class' => 'col-xs-%s',
                'offset-class' => 'col-xs-offset-%s',
                'push-class' => 'col-xs-push-%s',
                'pull-class' => 'col-xs-pull-%s'
                ],
            'sm' =>
                [
                'name' => 'small',
                'column-class' => 'col-sm-%s',
                'offset-class' => 'col-sm-offset-%s',
                'push-class' => 'col-sm-push-%s',
                'pull-class' => 'col-sm-pull-%s'
                ],
            'md' =>
                [
                'name' => 'medium',
                'column-class' => 'col-md-%s',
                'offset-class' => 'col-md-offset-%s',
                'push-class' => 'col-md-push-%s',
                'pull-class' => 'col-md-pull-%s'
                ],
            'lg' =>
                [
                'name' => 'large',
                'column-class' => 'col-lg-%s',
                'offset-class' => 'col-lg-offset-%s',
                'push-class' => 'col-lg-push-%s',
                'pull-class' => 'col-lg-pull-%s'
                ],
            'xl' =>
                [
                'name' => 'extra large',
                'column-class' => 'col-xl-%s',
                'offset-class' => 'col-xl-offset-%s',
                'push-class' => 'col-xl-push-%s',
                'pull-class' => 'col-xl-pull-%d'
                ]
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['foundation'] =
    [
    'name' => 'Foundation',
    'config' =>
        [
        'hasRows' => true,
        'hasColumns' => true,
        'hasBlockGrid' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'row',
        'column-class' => 'columns',
        'block-sizes' => ['1','2','3','4','5','6','7','8'],
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'block-config' =>
            [
            'small' =>
                [
                'name' => 'small',
                'block-class' => 'small-up-%d'
                ],
            'medium' =>
                [
                'name' => 'medium',
                'block-class' => 'medium-up-%d'
                ],
            'large' =>
                [
                'name' => 'large',
                'block-class' => 'large-up-%d'
                ]
            ],
        'columns-config' =>
            [
            'small' =>
                [
                'name' => 'small',
                'column-class' => 'small-%d',
                'offset-class' => 'small-offset-%d',
                'push-class' => 'small-push-%d',
                'pull-class' => 'small-pull-%d'
                ],
            'medium' =>
                [
                'name' => 'medium',
                'column-class' => 'medium-%d',
                'offset-class' => 'medium-offset-%d',
                'push-class' => 'medium-push-%d',
                'pull-class' => 'medium-pull-%d'
                ],
            'large' =>
                [
                'name' => 'large',
                'column-class' => 'large-%d',
                'offset-class' => 'large-offset-%d',
                'push-class' => 'large-push-%d',
                'pull-class' => 'large-pull-%d'
                ]
            ],
        'additional-classes' =>
            [
            'row' => ['expanded','column','small-uncollapse','medium-uncollapse','large-uncollapse','small-collapse','medium-collapse','large-collapse'],
            'columns' => ['end','small-centered','medium-centered','large-centered','small-uncentered','medium-uncentered','large-uncentered']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['foundation-xy'] =
    [
    'name' => 'Foundation 6 (XY Grid)',
    'config' =>
        [
        'hasRows' => true,
        'hasRowClasses' => true,
        'hasColumns' => true,
        'hasColumnClasses' => true,
        'hasColumnOffset' => true,
        'hasColumnPush' => true,
		'hasBlockGrid' => true,
        'column-class' => 'cell',
        'block-sizes' => ['1','2','3','4','5','6','7','8'],
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'block-config' =>
            [
            'small' =>
                [
                'name' => 'small',
                'block-class' => 'small-up-%d'
                ],
            'medium' =>
                [
                'name' => 'medium',
                'block-class' => 'medium-up-%d'
                ],
            'large' =>
                [
                'name' => 'large',
                'block-class' => 'large-up-%d'
                ]
            ],
        'columns-config' =>
            [
            'small' =>
                [
                'name' => 'small',
                'column-class' => 'small-%d',
                'offset-class' => 'small-offset-%d',
                'push-class' => 'small-order-%d',
                ],
            'medium' =>
                [
                'name' => 'medium',
                'column-class' => 'medium-%d',
                'offset-class' => 'medium-offset-%d',
                'push-class' => 'medium-order-%d',
                ],
            'large' =>
                [
                'name' => 'large',
                'column-class' => 'large-%d',
                'offset-class' => 'large-offset-%d',
                'push-class' => 'large-order-%d',
                ],
            ],

        'hasWrapper' => true,
        'hasWrapperClasses' => true,
        'wrapper-class' => 'grid-container',

        'additional-classes' =>
            [
            'wrapper' => ['fluid', 'full'],
            'row' => ['grid-x', 'grid-y', 'grid-margin-x', 'small-margin-collapse', 'medium-margin-collapse', 'large-margin-collapse', 'grid-padding-x', 'small-padding-collapse', 'medium-padding-collapse', 'large-padding-collapse', 'small-grid-frame', 'medium-grid-frame', 'large-grid-frame'],
            'columns' => ['auto', 'shrink', 'small-auto', 'medium-auto', 'large-auto', 'small-shrink', 'medium-shrink', 'large-shrink', 'small-centered','medium-centered','large-centered','small-uncentered','medium-uncentered','large-uncentered']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['delos'] =
    [
    'name' => 'DELOS',
    'config' =>
        [
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => false,
        'hasColumnClasses' => false,
        'row-class' => 'row',
        'columns-sizes' => ['3','4','6','8','9','12'],
        'columns-config' =>
            [
            'small' =>
                [
                'name' => 'small',
                'column-class' => 'col-small-%d',
                'offset-class' => 'offset-small-%d',
                'push-class' => 'push-small-%d',
                'pull-class' => 'pull-small-%d'
                ],
            'medium' =>
                [
                'name' => 'medium',
                'column-class' => 'col-medium-%d',
                'offset-class' => 'offset-medium-%d',
                'push-class' => 'push-medium-%d',
                'pull-class' => 'pull-medium-%d'
                ],
            'large' =>
                [
                'name' => 'large',
                'column-class' => 'col-large-%d',
                'offset-class' => 'offset-large-%d',
                'push-class' => 'push-large-%d',
                'pull-class' => 'pull-large-%d'
                ]
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['unsemantic'] =
    [
    'name' => 'unsemantic',
    'config' =>
        [
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => true,
        'hasColumnPush' => true,
        'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'grid-container',
        'columns-sizes' => ['5','10','15','20','25','30','33','35','40','45','50','55','60','65','66','70','75','80','85','90','95','100'],
        'columns-config' =>
            [
            'mobile' =>
                [
                'name' => 'mobile',
                'column-class' => 'mobile-grid-%d',
                'offset-class' => 'mobile-prefix-%d',
                'offset-right-class' => 'mobile-suffix-%d',
                'push-class' => 'mobile-push-%d',
                'pull-class' => 'mobile-pull-%d'
                ],
            'tablet' =>
                [
                'name' => 'tablet',
                'column-class' => 'tablet-grid-%d',
                'offset-class' => 'tablet-prefix-%d',
                'offset-right-class' => 'tablet-suffix-%d',
                'push-class' => 'tablet-push-%d',
                'pull-class' => 'tablet-pull-%d'
                ],
            'desktop' =>
                [
                'name' => 'desktop',
                'column-class' => 'grid-%d',
                'offset-class' => 'prefix-%d',
                'offset-right-class' => 'suffix-%d',
                'push-class' => 'push-%d',
                'pull-class' => 'pull-%d'
                ]
            ],
        'additional-classes' =>
            [
            'row' => ['grid-offset'],
            'columns' => ['grid-parent','grid-offset','hide-on-mobile','hide-on-tablet','hide-on-desktop']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['gridlex'] =
    [
    'name' => 'gridlex',
    'config' =>
        [
        'hasRows' => true,
        'hasColumns' => true,
        'hasBlockGrid' => true,
        //'hasColumnOffset' => true,
        //'hasColumnOffsetRight' => true,
        //'hasColumnPush' => true,
        //'hasColumnPull' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'row-class' => 'grid',
        'column-class' => 'col',
        'block-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'block-config' =>
            [
            'all' =>
                [
                'name' => 'all',
                'block-class' => '^-%d',
                ],
            'xs' =>
                [
                'name' => 'xs',
                'block-class' => '^_xs-%d',
                ],
            'sm' =>
                [
                'name' => 'sm',
                'block-class' => '^_sm-%d',
                ],
            'md' =>
                [
                'name' => 'medium',
                'block-class' => '^_md-%d',
                ],
            'lg' =>
                [
                'name' => 'large',
                'block-class' => '^_lg-%d',
                ]
            ],
        'columns-config' =>
            [
            'all' =>
                [
                'name' => 'all',
                'column-class' => '^-%d',
                ],
            'xs' =>
                [
                'name' => 'xs',
                'column-class' => '^_xs-%d',
                ],
            'sm' =>
                [
                'name' => 'sm',
                'column-class' => '^_sm-%d',
                ],
            'md' =>
                [
                'name' => 'medium',
                'column-class' => '^_md-%d',
                ],
            'lg' =>
                [
                'name' => 'large',
                'column-class' => '^_lg-%d',
                ]
            ],
        'additional-classes' =>
            [
            'row' => ['^-center', '^-right', '^-middle', '^-bottom', '^-spaceBetween', '^-spaceAround', '^-reverse', '^-column', '^-column-reverse', '^-noGutter', '^-equalHeight'],
            'columns' => ['col-first', 'col-last']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_CONFIG']['flexboxgrid'] =
    [
    'name' => 'Flexbox Grid',
    'config' =>
        [
        'hasWrapper' => true,
        'hasRows' => true,
        'hasColumns' => true,
        'hasColumnOffset' => true,
        'hasColumnOffsetRight' => false,
        'hasColumnPush' => false,
        'hasColumnPull' => false,
        'hasWrapperClasses' => true,
        'hasRowClasses' => true,
        'hasColumnClasses' => true,
        'wrapper-class' => '',
        'row-class' => 'row',
        'column-class' => '',
        'columns-sizes' => ['1','2','3','4','5','6','7','8','9','10','11','12'],
        'columns-config' =>
            [
            'xs' =>
                [
                'name' => 'extra small',
                'column-class' => 'col-xs-%d',
                'offset-class' => 'col-xs-offset-%d',

                ],
            'sm' =>
                [
                'name' => 'small',
                'column-class' => 'col-sm-%d',
                'offset-class' => 'col-sm-offset-%d'
                ],
            'md' =>
                [
                'name' => 'medium',
                'column-class' => 'col-md-%d',
                'offset-class' => 'col-md-offset-%d'
                ],
            'lg' =>
                [
                'name' => 'large',
                'column-class' => 'col-lg-%d',
                'offset-class' => 'col-lg-offset-%d'
                ],
            ],
        'additional-classes' =>
            [
            'wrapper' => ['container', 'container-fluid'],
            'row' => ['start-xs', 'center-xs', 'end-xs', 'top-xs', 'middle-xs', 'bottom-xs', 'around-xs', 'between-xs', 'reverse'],
            'columns' => ['col-xs', 'col-sm', 'col-md', 'col-lg', 'first-xs', 'first-sm', 'first-md', 'first-lg', 'last-xs', 'last-sm', 'last-md', 'last-lg']
            ]
        ]
    ];

$GLOBALS['DMA_SIMPLEGRID_FALLBACK'] = 'delos';
