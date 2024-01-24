<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class ContentSimpleGridWrapperStart extends ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_wrapperstart';



    /**
     * Return if the highlighter plugin is not loaded
     *
     * @return string
     */
    public function generate()
    {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')))
        {
            $this->strTemplate = 'be_wildcard';
            $objTemplate = new BackendTemplate($this->strTemplate);

            //$objTemplate->wildcard = "SimpleGrid: Row Start";

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

        $strAdditionalClasses = "";

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false))
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false) && $arrConfigData['config']['additional-classes']['wrapper'] && $this->dma_simplegrid_additionalwrapperclasses)
        {
            $arrAdditionalClasses = StringUtil::deserialize($this->dma_simplegrid_additionalwrapperclasses, true);

            if (sizeof($arrAdditionalClasses) > 0)
            {
                foreach ($arrAdditionalClasses as $strClassKey)
                {
                    $strAdditionalClasses .= " " . $strClassKey;
                }
            }
        }

        $this->type = "wrapper ". $arrConfigData['config']['wrapper-class'] . $strAdditionalClasses;

    }

}
