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
class DmaSimpleGrid extends \Controller
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

    public function adjustPalettesString($dc)
    {

        $strDmaSimpleGridPaletteString = "";

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useColumns'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_columnsettings";
        }
        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_offsetsettings";
        }
        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_pullsettings";
        }
        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'])
        {
            $strDmaSimpleGridPaletteString .= ",dma_simplegrid_pushsettings";
        }


        if ($dc->__get('table') == "tl_content")
        {
            foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $palette)
            {
                if (!is_array($palette) && strpos($palette, "cssID")!==false)
                {
                    $GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace
                    (
                        '{invisible_legend',
                        '{dma_simplegrid_legend}' . $strDmaSimpleGridPaletteString . ';{invisible_legend',
                        $GLOBALS['TL_DCA']['tl_content']['palettes'][$k]
                    );
                }
            }
        };

        if ($dc->__get('table') == "tl_form_field")
        {

            foreach ($GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $k => $palette)
            {
                if (!is_array($palette) && strpos($palette, "class")!==false)
                {
                    $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$k] = str_replace
                    (
                        '{template_legend',
                        '{dma_simplegrid_legend}' . $strDmaSimpleGridPaletteString . ';{template_legend',
                        $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$k]
                    );
                }
            }
        }
    }

    public function getGridTypes()
    {
        $arrGridTypes = array();

        foreach ($GLOBALS['DMA_SIMPLEGRID_CONFIG'] as $keyValue => $arrGridConfig)
        {
            $arrGridTypes[$keyValue] = $arrGridConfig['name'];
        }

        return $arrGridTypes;
    }

    public function simplegridLoadFormField($objWidget, $formId, $arrData, $objForm)
    {

        if ($objForm->tableless && ($objWidget->dma_simplegrid_columnsettings || $objWidget->dma_simplegrid_offsetsettings || $objWidget->dma_simplegrid_pushsettings || $objWidget->dma_simplegrid_pullsettings))
        {

            $strWidgetClasses = "";

            if ($this->arrConfigData['config']['column-class'])
            {
                $strWidgetClasses .= $this->arrConfigData['config']['column-class'];
            }

            $strWidgetClasses .= ($strWidgetClasses!="" ? " " : "") . $this->getSimpleGridColumnClasses($objWidget->dma_simplegrid_columnsettings, $objWidget->dma_simplegrid_offsetsettings, $objWidget->dma_simplegrid_pushsettings, $objWidget->dma_simplegrid_pullsettings);

            if ($objWidget->__get('prefix') != "")
            {
                $strWidgetClasses = " " . $strWidgetClasses;
            }

            $objWidget ->__set('prefix', $objWidget->__get('prefix') . $strWidgetClasses);
        }

        return $objWidget;
    }

    public function simplegridParseTemplate($objTemplate)
    {
        if ($objTemplate->dma_simplegrid_columnsettings || $objTemplate->dma_simplegrid_offsetsettings || $objTemplate->dma_simplegrid_pushsettings || $objTemplate->dma_simplegrid_pullsettings) {

            if ($this->arrConfigData['config']['column-class'])
            {
                $objTemplate->class .= " " . $this->arrConfigData['config']['column-class'];
            }

            $objTemplate->class .= " " . $this->getSimpleGridColumnClasses($objTemplate->dma_simplegrid_columnsettings, $objTemplate->dma_simplegrid_offsetsettings, $objTemplate->dma_simplegrid_pushsettings, $objTemplate->dma_simplegrid_pullsettings);
        }
    }

    /**
     * tl_content DCA onsubmit callback
     *
     * Creates a stop element after a start element was created
     *
     * @param  \DataContainer $dc Data container
     * @return void
     */

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

    }


    public function columnsSelectCallback()
    {
        $arrColumnsSetting = array();

        if ($this->arrConfigData['config']['columns-config']) {
            foreach ($this->arrConfigData['config']['columns-config'] as $configName => $arrColumnConfig) {
                $arrColumnsSetting[$configName] = array
                (
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => $this->arrConfigData['config']['columns-sizes'],
                    'eval' => array('includeBlankOption' => true, 'style' => 'width:115px')
                );
            }
        }

        return $arrColumnsSetting;
    }

    public function getColumnsShowString($arrColumnSettings, $arrOffsetSettings=array(), $arrPushSettings=array(), $arrPullSettings=array())
    {
        $strReturn = "";
        $arrConfiguredClasses = array();

        if (!is_array($arrColumnSettings)) {
            $arrColumnSettings = deserialize($arrColumnSettings, true);
        }
        if (!is_array($arrOffsetSettings)) {
            $arrOffsetSettings = deserialize($arrOffsetSettings, true);
        }
        if (!is_array($arrPushSettings)) {
            $arrPushSettings = deserialize($arrPushSettings, true);
        }
        if (!is_array($arrPullSettings)) {
            $arrPullSettings = deserialize($arrPullSettings, true);
        }

        if (sizeof($arrColumnSettings) == 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = $this->arrConfigData['config']['columns-config'][$columnKey]['name'] . ": " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrOffsetSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset']) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = $this->arrConfigData['config']['columns-config'][$columnKey]['name'] . "-offset: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPushSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush']) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = $this->arrConfigData['config']['columns-config'][$columnKey]['name'] . "-push: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPullSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull']) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = $this->arrConfigData['config']['columns-config'][$columnKey]['name'] . "-pull: " . $varValue;
                    }
                }
            }
        }

        $strReturn = implode('; ', $arrConfiguredClasses);

        return $strReturn;

    }

    public function getSimpleGridColumnClasses($arrColumnSettings, $arrOffsetSettings=array(), $arrPushSettings=array(), $arrPullSettings=array())
    {

        $arrConfiguredClasses = array();

        if (!is_array($arrColumnSettings)) {
            $arrColumnSettings = deserialize($arrColumnSettings, true);
        }
        if (!is_array($arrOffsetSettings)) {
            $arrOffsetSettings = deserialize($arrOffsetSettings, true);
        }
        if (!is_array($arrPushSettings)) {
            $arrPushSettings = deserialize($arrPushSettings, true);
        }
        if (!is_array($arrPullSettings)) {
            $arrPullSettings = deserialize($arrPullSettings, true);
        }

        if (sizeof($arrColumnSettings) == 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf($this->arrConfigData['config']['columns-config'][$columnKey]['column-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrOffsetSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset']) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf($this->arrConfigData['config']['columns-config'][$columnKey]['offset-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrPushSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush']) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf($this->arrConfigData['config']['columns-config'][$columnKey]['push-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrPullSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull']) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf($this->arrConfigData['config']['columns-config'][$columnKey]['pull-class'], $varValue);
                    }
                }
            }
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        return $strClasses;
    }

    public function getSimpleGridInfos($arrRow)
    {

        $strGridInfo = "";

        if ($arrRow['dma_simplegrid_columnsettings'])
        {

            $strGridInfo .= '<span class="tl_gray" style="padding-right:10px;">' . $this->getColumnsShowString($arrRow['dma_simplegrid_columnsettings'], $arrRow['dma_simplegrid_offsetsettings'], $arrRow['dma_simplegrid_pushsettings'], $arrRow['dma_simplegrid_pullsettings']) . '</span>';

        }

        return $strGridInfo;
    }
}