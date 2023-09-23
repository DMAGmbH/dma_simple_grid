<?php

declare(strict_types=1);

/*
 * This file is part of Dma Simple Grid.
 *
 * (c) Janosch Oltmanns 2023 <kontakt@janosch-oltmanns.de>
 * @license LGPL-3.0+
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/DMAGmbH/dma_simple_grid
 */

namespace Dma\DmaSimpleGrid\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentSimpleGridRowStop extends ContentElement
{
    public const TYPE = 'dma_simplegrid_row_stop';

    protected $strTemplate = 'ce_dma_simplegrid_rowstop';

    /**
     * Compile the content element.
     */
    public function compile(): void
    {
        /** @var Request $request */
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        /** @var ScopeMatcher $matcher */
        $matcher = System::getContainer()->get('contao.routing.scope_matcher');

        if ($matcher->isBackendRequest($request)) {
            $this->strTemplate = 'be_wildcard';

            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
            //$this->Template->wildcard = "SimpleGrid: Row Stop";
        }
    }
}
