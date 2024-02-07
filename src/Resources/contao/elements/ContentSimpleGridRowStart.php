<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;

use Contao\ArrayUtil;
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
class ContentSimpleGridRowStart extends ContentElement
{
    /**
     * @var string Template
     */
    protected $strTemplate = 'ce_dma_simplegrid_rowstart';

    public function generate(): string
    {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {
            $this->strTemplate = 'be_wildcard';
            return (new BackendTemplate($this->strTemplate))->parse();
        }

        return parent::generate();
    }


    /**
     * Compile the content element
     */
    public function compile(): void
    {
        $arrConfiguredClasses = [];

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false)) {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useBlockGrid'] ?? false) && $this->dma_simplegrid_blocksettings) {
            $arrBlockSettings = StringUtil::deserialize($this->dma_simplegrid_blocksettings, true);
            if (count($arrBlockSettings) === 1) {
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

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false) && $arrConfigData['config']['additional-classes']['row'] && $this->dma_simplegrid_additionalrowclasses) {
            $arrAdditionalClasses = StringUtil::deserialize($this->dma_simplegrid_additionalrowclasses, true);
            if (count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if ($arrConfigData['config']['row-class'] ?? false) {
            ArrayUtil::arrayInsert($arrConfiguredClasses, 0, $arrConfigData['config']['row-class']);
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        if (str_contains($strClasses, '^')) {
            $strClasses = str_replace(' ^', '', $strClasses);
        }

        $this->type = 'row ' . $strClasses;
    }

}
