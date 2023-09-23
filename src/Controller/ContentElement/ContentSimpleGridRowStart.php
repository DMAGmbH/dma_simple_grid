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

use Contao\ArrayUtil;
use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentSimpleGridRowStart extends ContentElement
{
    public const TYPE = 'dma_simplegrid_row_start';

    protected $strTemplate = 'ce_dma_simplegrid_rowstart';

    /**
     * Return if the highlighter plugin is not loaded.
     *
     * @return string
     */
    public function generate()
    {
        /** @var Request $request */
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        /** @var ScopeMatcher $matcher */
        $matcher = System::getContainer()->get('contao.routing.scope_matcher');

        if ($matcher->isBackendRequest($request)) {
            $this->strTemplate = 'be_wildcard';
            $objTemplate = new BackendTemplate($this->strTemplate);
            //$objTemplate->wildcard = "SimpleGrid: Row Start";

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Compile the content element.
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

            if (1 === \count($arrBlockSettings)) {
                $arrElementSettings = $arrBlockSettings[0];

                if (\is_array($arrElementSettings)) {
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

            if (\count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if ($arrConfigData['config']['row-class'] ?? false) {
            ArrayUtil::arrayInsert($arrConfiguredClasses, 0, $arrConfigData['config']['row-class']);
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        if (false !== strpos($strClasses, '^')) {
            $strClasses = str_replace(' ^', '', $strClasses);
        }

        $this->type = 'row '.$strClasses;
    }
}