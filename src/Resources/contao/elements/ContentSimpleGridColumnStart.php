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
class ContentSimpleGridColumnStart extends \ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_columnstart';


    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $this->strTemplate = 'be_wildcard';
            $objTemplate = new \BackendTemplate($this->strTemplate);
            //$objTemplate->wildcard = "SimpleGrid: Column Start";

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Compile the content element
     *
     * @return void
     */
    public function compile()
    {


        $this->type = "column";

    }

}