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

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentSimpleGridWrapperStart extends ContentElement
{
    public const TYPE = 'dma_simplegrid_wrapper_start';

    protected $strTemplate = 'ce_dma_simplegrid_wrapperstart';

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
        $strAdditionalClasses = '';

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false)) {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            $arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false) && $arrConfigData['config']['additional-classes']['wrapper'] && $this->dma_simplegrid_additionalwrapperclasses) {
            $arrAdditionalClasses = StringUtil::deserialize($this->dma_simplegrid_additionalwrapperclasses, true);

            if (\count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $strAdditionalClasses .= ' '.$strClassKey;
                }
            }
        }

        $this->type = 'wrapper '.$arrConfigData['config']['wrapper-class'].$strAdditionalClasses;
    }
}
