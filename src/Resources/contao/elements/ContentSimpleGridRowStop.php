<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class ContentSimpleGridRowStop extends \Contao\ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_rowstop';


    /**
     * Compile the content element
     *
     * @return void
     */
    public function compile()
    {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')))
        {
            $this->strTemplate = 'be_wildcard';

            $objTemplate = new \Contao\BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
            //$this->Template->wildcard = "SimpleGrid: Row Stop";
        }
    }

}
