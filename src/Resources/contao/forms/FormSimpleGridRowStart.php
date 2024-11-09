<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;

use Contao\BackendTemplate;
use Contao\StringUtil;
use Contao\System;
use Contao\Widget;
use Symfony\Component\HttpFoundation\Request;

/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class FormSimpleGridRowStart extends Widget
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_dma_simplegrid_rowstart';


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
            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FFL']['dma_simplegrid_row_start'][0]) . ' ###';

            return $objTemplate->parse();
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false)) {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_FALLBACK']];
        }

        $strAdditionalClasses = $arrConfigData['config']['row-class'] ?? '';

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false) && $arrConfigData['config']['additional-classes']['row'] && $this->dma_simplegrid_additionalrowclasses) {
            $arrAdditionalClasses = StringUtil::deserialize($this->dma_simplegrid_additionalrowclasses, true);
            if (count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $strAdditionalClasses .= ' ' . $strClassKey;
                }
            }
        }

        $this->strPrefix = '' . $strAdditionalClasses;

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
