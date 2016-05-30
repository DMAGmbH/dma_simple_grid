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
class ContentSimpleGridRowStart extends \ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_rowstart';



    /**
     * Return if the highlighter plugin is not loaded
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $this->strTemplate = 'be_wildcard';
            $objTemplate = new \BackendTemplate($this->strTemplate);
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

        $arrConfiguredClasses = array();

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] && $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']])
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useBlockGrid'] && $this->dma_simplegrid_blocksettings)
        {
            $arrBlockSettings = deserialize($this->dma_simplegrid_blocksettings, true);
            if (sizeof($arrBlockSettings) == 1)
            {
                $arrElementSettings = $arrBlockSettings[0];
                if (is_array($arrElementSettings)) {
                    foreach ($arrElementSettings as $columnKey => $varValue) {
                        if ($varValue) {
                            $arrConfiguredClasses[] = sprintf($arrConfigData['config']['block-config'][$columnKey]['block-class'], $varValue);
                        }
                    }
                }
            }

        }

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] && $arrConfigData['config']['additional-classes']['row'] && $this->dma_simplegrid_additionalrowclasses)
        {
            $arrAdditionalClasses = deserialize($this->dma_simplegrid_additionalrowclasses, true);

            if (sizeof($arrAdditionalClasses) > 0)
            {
                foreach ($arrAdditionalClasses as $strClassKey)
                {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if ($arrConfigData['config']['row-class'])
        {
            array_insert($arrConfiguredClasses, 0, $arrConfigData['config']['row-class']);
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        if (strpos($strClasses, "^") !== false)
        {
            $strClasses = str_replace(" ^", "", $strClasses);
        }


        $this->type = "row ". $strClasses;

    }

}