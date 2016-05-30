<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;
/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class ContentSimpleGridWrapperStop extends \ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_wrapperstop';


    /**
     * Compile the content element
     *
     * @return void
     */
    public function compile()
    {
        if (TL_MODE == 'BE')
        {
            $this->strTemplate = 'be_wildcard';

            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
        }
    }

}