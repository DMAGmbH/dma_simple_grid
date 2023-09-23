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

namespace Dma\DmaSimpleGrid\Controller\FormField;

use Contao\BackendTemplate;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\System;
use Contao\Widget;
use Symfony\Component\HttpFoundation\Request;

/**
 * SimpleGrid row start content element.
 */
class FormSimpleGridRowStop extends Widget
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'form_dma_simplegrid_rowstop';

    /**
     * Do not validate.
     */
    public function validate(): void
    {
    }

    /**
     * Parse the template file and return it as string.
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes = null): string
    {
        /** @var Request $request */
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        /** @var ScopeMatcher $matcher */
        $matcher = System::getContainer()->get('contao.routing.scope_matcher');

        if (version_compare(VERSION, '4.0', '>=') && $matcher->isBackendRequest($request)) {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### '.mb_strtoupper($GLOBALS['TL_LANG']['FFL']['dma_simplegrid_row_stop'][0]).' ###';

            return $objTemplate->parse();
        }

        return parent::parse($arrAttributes);
    }

    /**
     * Generate the widget and return it as string.
     *
     * @return string The widget markup
     */
    public function generate(): string
    {
        return '';
    }
}
