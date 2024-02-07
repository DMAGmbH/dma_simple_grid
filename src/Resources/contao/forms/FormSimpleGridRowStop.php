<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;

use Contao\BackendTemplate;
use Contao\System;
use Contao\Widget;
use Symfony\Component\HttpFoundation\Request;

/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class FormSimpleGridRowStop extends Widget
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_dma_simplegrid_rowstop';


    /**
     * Do not validate
     */
    public function validate(): void
    {
    }


    /**
     * Parse the template file and return it as string
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes = null): string
    {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {
            /** @var BackendTemplate|object $objTemplate */
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FFL']['dma_simplegrid_row_stop'][0]) . ' ###';

            return $objTemplate->parse();
        }

        return parent::parse($arrAttributes);
    }


    /**
     * Generate the widget and return it as string
     *
     * @return string The widget markup
     */
    public function generate(): string
    {
        return '';
    }

}
