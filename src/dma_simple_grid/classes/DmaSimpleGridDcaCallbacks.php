<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DMA;

/**
 * DMA SimpleGrid DCA (tl_content and tl_module)
 *
 * Provide miscellaneous methods that are used by the data configuration arrays.
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class DmaSimpleGridDcaCallbacks extends \Controller
{

    private $arrConfigData;

    protected function __construct()
    {
        parent::__construct();

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] && $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']])
        {
            $this->arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            $this->arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }

    }


    public function adjustSettingsPalettesString()
    {

        $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ";{dma_simplegrid_legend},dmaSimpleGridType";

        if (DmaSimpleGrid::getConfigData('hasColumns'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useColumns";
        }

        if (DmaSimpleGrid::getConfigData('hasColumnOffset'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useOffset";
        }

        if (DmaSimpleGrid::getConfigData('hasColumnOffsetRight'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useOffsetRight";
        }

        if (DmaSimpleGrid::getConfigData('hasColumnPush'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_usePush";
        }

        if (DmaSimpleGrid::getConfigData('hasColumnPull'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_usePull";
        }

        if (DmaSimpleGrid::getConfigData('hasBlockGrid'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useBlockGrid";
        }

        if (DmaSimpleGrid::getConfigData('hasWrapperClasses'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useAdditionalWrapperClasses";
        }

        if (DmaSimpleGrid::getConfigData('hasRowClasses'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useAdditionalRowClasses";
        }

        if (DmaSimpleGrid::getConfigData('hasColumnClasses'))
        {
            $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ",dmaSimpleGrid_useAdditionalColumnClasses";
        }

        $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ";";
    }

    public function adjustPalettesString($dc)
    {

        $strDmaSimpleGridPaletteString = "";

        if (DmaSimpleGrid::getConfigData('hasColumns') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useColumns'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_columnsettings";
        }
        if (DmaSimpleGrid::getConfigData('hasColumnOffset') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_offsetsettings";
        }
        if (DmaSimpleGrid::getConfigData('hasColumnOffsetRight') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_offsetrightsettings";
        }
        if (DmaSimpleGrid::getConfigData('hasColumnPull') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_pullsettings";
        }
        if (DmaSimpleGrid::getConfigData('hasColumnPush') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_pushsettings";
        }
        if (DmaSimpleGrid::getConfigData('hasColumnClasses') && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_additionalcolumnclasses";
        }


        if ($dc->__get('table') == "tl_content")
        {

            if (!DmaSimpleGrid::getConfigData('hasRows'))
            {
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_start']);
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_stop']);
            }

            if (!DmaSimpleGrid::getConfigData('hasWrapper'))
            {
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_start']);
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_stop']);
            }

            $arrNotSupportedOrUsefulElements = array('module', 'dma_simplegrid_row_start', 'dma_simplegrid_wrapper_start');

            foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $palette)
            {


                $strDmaSimpleGridPaletteStringOnce = $strDmaSimpleGridPaletteString;

                if (!is_array($palette) && strpos($palette, "cssID")!==false && !in_array($k, $arrNotSupportedOrUsefulElements))
                {

                    $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace
                    (
                        '{invisible_legend',
                        '{dma_simplegrid_legend}' . $strDmaSimpleGridPaletteStringOnce . ';{invisible_legend',
                        $GLOBALS['TL_DCA']['tl_content']['palettes'][$k]
                    );
                }

                if ($k == "dma_simplegrid_row_start")
                {

                    $strRowStartFields = "";

                    if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useBlockGrid'] && DmaSimpleGrid::getConfigData('hasBlockGrid'))
                    {
                        $strRowStartFields .= ",dma_simplegrid_blocksettings";
                    }

                    if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] && $this->arrConfigData['config']['additional-classes']['row'])
                    {
                        $strRowStartFields .= ",dma_simplegrid_additionalrowclasses";
                    }

                    if ($strRowStartFields != "")
                    {
                        $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace
                        (
                            '{invisible_legend',
                            '{dma_simplegrid_legend}' . $strRowStartFields . ';{invisible_legend',
                            $GLOBALS['TL_DCA']['tl_content']['palettes'][$k]
                        );
                    }

                }

                if ($k == "dma_simplegrid_wrapper_start")
                {
                    if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] && $this->arrConfigData['config']['additional-classes']['wrapper'])
                    {
                        $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace
                        (
                            '{invisible_legend',
                            '{dma_simplegrid_legend},dma_simplegrid_additionalwrapperclasses;{invisible_legend',
                            $GLOBALS['TL_DCA']['tl_content']['palettes'][$k]
                        );
                    }
                }
            }
        };

        if ($dc->__get('table') == "tl_form_field")
        {

            foreach ($GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $k => $palette)
            {

                $strDmaSimpleGridPaletteStringOnce = $strDmaSimpleGridPaletteString;

                if (!is_array($palette) && strpos($palette, "class")!==false)
                {
                    if ($k == "dma_simplegrid_row_start")
                    {
                        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] && $this->arrConfigData['config']['additional-classes']['row'])
                        {
                            $strDmaSimpleGridPaletteStringOnce .= ",dma_simplegrid_additionalrowclasses";
                        }
                    }
                    $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$k] = str_replace
                    (
                        '{template_legend',
                        '{dma_simplegrid_legend}' . $strDmaSimpleGridPaletteStringOnce . ';{template_legend',
                        $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$k]
                    );
                }
            }
        }
    }

    public function onsubmitCallbackFormField($dc)
    {
        $activeRecord = $dc->activeRecord;
        if (!$activeRecord) {
            return;
        }

        if ($activeRecord->type === 'dma_simplegrid_column_start') {

            // Find the next columns or column element
            $nextElement = \Database::getInstance()
                ->prepare('
					SELECT type
					FROM tl_form_field
					WHERE pid = ?
						AND type IN (\'dma_simplegrid_column_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
                ->execute(
                    $activeRecord->pid,
                    $activeRecord->sorting
                );

            // Check if a stop element should be created
            if (!$nextElement->type) {
                \Database::getInstance()
                    ->prepare('INSERT INTO tl_form_field %s')
                    ->set(array(
                        'pid' => $activeRecord->pid,
                        'type' => 'dma_simplegrid_column_stop',
                        'sorting' => $activeRecord->sorting + 1,
                        'tstamp' => time(),
                    ))
                    ->execute();
            }

        }

        if ($activeRecord->type === 'dma_simplegrid_row_start') {

            // Find the next columns or column element
            $nextElement = \Database::getInstance()
                ->prepare('
					SELECT type
					FROM tl_form_field
					WHERE pid = ?
						AND type IN (\'dma_simplegrid_row_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
                ->execute(
                    $activeRecord->pid,
                    $activeRecord->sorting
                );

            // Check if a stop element should be created
            if (!$nextElement->type) {
                \Database::getInstance()
                    ->prepare('INSERT INTO tl_form_field %s')
                    ->set(array(
                        'pid' => $activeRecord->pid,
                        'type' => 'dma_simplegrid_row_stop',
                        'sorting' => $activeRecord->sorting + 1,
                        'tstamp' => time(),
                    ))
                    ->execute();
            }

        }
    }

    public function onsubmitCallback($dc)
    {
        $activeRecord = $dc->activeRecord;
        if (!$activeRecord) {
            return;
        }

        if ($activeRecord->type === 'dma_simplegrid_column_start') {

            // Find the next columns or column element
            $nextElement = \Database::getInstance()
                ->prepare('
					SELECT type
					FROM tl_content
					WHERE pid = ?
						AND (ptable = ? OR ptable = ?)
						AND type IN (\'dma_simplegrid_column_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
                ->execute(
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    $activeRecord->ptable === 'tl_article' ? '' : $activeRecord->ptable,
                    $activeRecord->sorting
                );

            // Check if a stop element should be created
            if (!$nextElement->type) {
                \Database::getInstance()
                    ->prepare('INSERT INTO tl_content %s')
                    ->set(array(
                        'pid' => $activeRecord->pid,
                        'ptable' => $activeRecord->ptable ?: 'tl_article',
                        'type' => 'dma_simplegrid_column_stop',
                        'sorting' => $activeRecord->sorting + 1,
                        'tstamp' => time(),
                    ))
                    ->execute();
            }

        }

        if ($activeRecord->type === 'dma_simplegrid_row_start') {

            // Find the next columns or column element
            $nextElement = \Database::getInstance()
                ->prepare('
					SELECT type
					FROM tl_content
					WHERE pid = ?
						AND (ptable = ? OR ptable = ?)
						AND type IN (\'dma_simplegrid_row_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
                ->execute(
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    $activeRecord->ptable === 'tl_article' ? '' : $activeRecord->ptable,
                    $activeRecord->sorting
                );

            // Check if a stop element should be created
            if (!$nextElement->type) {
                \Database::getInstance()
                    ->prepare('INSERT INTO tl_content %s')
                    ->set(array(
                        'pid' => $activeRecord->pid,
                        'ptable' => $activeRecord->ptable ?: 'tl_article',
                        'type' => 'dma_simplegrid_row_stop',
                        'sorting' => $activeRecord->sorting + 1,
                        'tstamp' => time(),
                    ))
                    ->execute();
            }

        }

        if ($activeRecord->type === 'dma_simplegrid_wrapper_start') {

            // Find the next columns or column element
            $nextElement = \Database::getInstance()
                ->prepare('
					SELECT type
					FROM tl_content
					WHERE pid = ?
						AND (ptable = ? OR ptable = ?)
						AND type IN (\'dma_simplegrid_wrapper_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
                ->execute(
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    $activeRecord->ptable === 'tl_article' ? '' : $activeRecord->ptable,
                    $activeRecord->sorting
                );

            // Check if a stop element should be created
            if (!$nextElement->type) {
                \Database::getInstance()
                    ->prepare('INSERT INTO tl_content %s')
                    ->set(array(
                        'pid' => $activeRecord->pid,
                        'ptable' => $activeRecord->ptable ?: 'tl_article',
                        'type' => 'dma_simplegrid_wrapper_stop',
                        'sorting' => $activeRecord->sorting + 1,
                        'tstamp' => time(),
                    ))
                    ->execute();
            }

        }

    }

}