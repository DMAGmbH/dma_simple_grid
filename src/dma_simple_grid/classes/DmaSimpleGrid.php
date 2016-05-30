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
class DmaSimpleGrid
{


    /**
     * Object instance (Singleton)
     * @var \Input
     */
    protected static $objInstance;

    /**
     * Cache
     * @var array
     */
    protected static $arrCache = array();

    public static function getData()
    {
        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        return static::$arrCache['grid'];
    }

    public static function getConfigData($strKey)
    {
        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        return static::$arrCache['grid']['config'][$strKey];
    }

    public static function hasDmaGridInfos($arrTemplateData)
    {
        $arrCheckableKeys = array
        (
            'dma_simplegrid_columnsettings',
            'dma_simplegrid_offsetsettings',
            'dma_simplegrid_offsetrightsettings',
            'dma_simplegrid_pushsettings',
            'dma_simplegrid_pullsettings'
        );

        $blnHasDmaGridInfos = false;

        foreach ($arrCheckableKeys as $checkableKey)
        {
            if ($arrTemplateData[$checkableKey])
            {
                $blnHasDmaGridInfos = true;
            }
        }

        return $blnHasDmaGridInfos;

    }

    public static function getColumnClasses($arrTemplateData)
    {

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $arrConfiguredClasses = array();

        if (!is_array($arrTemplateData['dma_simplegrid_columnsettings'])) {
            $arrColumnSettings = deserialize($arrTemplateData['dma_simplegrid_columnsettings'], true);
        }
        if (!is_array($arrTemplateData['dma_simplegrid_offsetsettings'])) {
            $arrOffsetSettings = deserialize($arrTemplateData['dma_simplegrid_offsetsettings'], true);
        }
        if (!is_array($arrTemplateData['dma_simplegrid_offsetrightsettings'])) {
            $arrOffsetRightSettings = deserialize($arrTemplateData['dma_simplegrid_offsetrightsettings'], true);
        }
        if (!is_array($arrTemplateData['dma_simplegrid_pushsettings'])) {
            $arrPushSettings = deserialize($arrTemplateData['dma_simplegrid_pushsettings'], true);
        }
        if (!is_array($arrTemplateData['dma_simplegrid_pullsettings'])) {
            $arrPullSettings = deserialize($arrTemplateData['dma_simplegrid_pullsettings'], true);
        }

        if (sizeof($arrColumnSettings) == 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['column-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrOffsetSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset']) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrOffsetRightSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight']) {
            $arrElementSettings = $arrOffsetRightSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-right-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrPushSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush']) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['push-class'], $varValue);
                    }
                }
            }
        }

        if (sizeof($arrPullSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull']) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['pull-class'], $varValue);
                    }
                }
            }
        }

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] && static::$arrCache['grid']['config']['additional-classes']['columns'])
        {
            $arrAdditionalClasses = deserialize($arrTemplateData['dma_simplegrid_additionalcolumnclasses'], true);

            if (sizeof($arrAdditionalClasses) > 0)
            {
                foreach ($arrAdditionalClasses as $strClassKey)
                {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if (sizeof($arrConfiguredClasses) > 0 || $arrTemplateData['type']=="dma_simplegrid_column_start") {
            if (static::$arrCache['grid']['config']['column-class'])
            {
                array_insert($arrConfiguredClasses, 0, static::$arrCache['grid']['config']['column-class']);
            }
        }


        $strClasses = implode(' ', $arrConfiguredClasses);

        if (strpos($strClasses, "^") !== false)
        {
            $strClasses = str_replace(" ^", "", $strClasses);
        }

        return $strClasses;

    }



    public static function getSimpleGridInfos($arrRow)
    {

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $strGridInfo = "";

        if ($arrRow['dma_simplegrid_columnsettings'] || $arrRow['dma_simplegrid_additionalwrapperclasses'])
        {
            $strGridInfo .= self::getColumnsShowString($arrRow);
        }

        if ($strGridInfo != "")
        {
            $strGridInfo = '<a href="#" class="tl_gray" style="padding-right:10px; white-space:nowrap; max-width:200px; display:inline-block; overflow:hidden; text-overflow:ellipsis;" title="' . $strGridInfo .'" onclick="return false;">' . $strGridInfo . '</a>';
        }

        return $strGridInfo;

    }

    public static function blockSelectCallback()
    {

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $arrColumnsSetting = array();

        if (static::$arrCache['grid']['config']['block-config']) {
            foreach (static::$arrCache['grid']['config']['block-config'] as $configName => $arrColumnConfig) {
                $arrColumnsSetting[$configName] = array
                (
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => static::$arrCache['grid']['config']['block-sizes'],
                    'eval' => array('includeBlankOption' => true, 'style' => 'width:115px')
                );
            }
        }

        return $arrColumnsSetting;

    }

    public static function columnsSelectCallback()
    {
        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $arrColumnsSetting = array();

        if (static::$arrCache['grid']['config']['columns-config']) {
            foreach (static::$arrCache['grid']['config']['columns-config'] as $configName => $arrColumnConfig) {
                $arrColumnsSetting[$configName] = array
                (
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => static::$arrCache['grid']['config']['columns-sizes'],
                    'eval' => array('includeBlankOption' => true, 'style' => 'width:115px')
                );
            }
        }

        return $arrColumnsSetting;
    }

    public static function getAdditionalWrapperClasses()
    {
        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['wrapper'];
    }

    public static function getAdditionalRowClasses()
    {

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['row'];
    }

    public static function getAdditionalColumnClasses()
    {

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['columns'];
    }

    public static function getColumnsShowString($arrRow)
    {
        $strReturn = "";
        $arrConfiguredClasses = array();

        if (!is_array($arrRow['dma_simplegrid_columnsettings'])) {
            $arrColumnSettings = deserialize($arrRow['dma_simplegrid_columnsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_offsetsettings'])) {
            $arrOffsetSettings = deserialize($arrRow['dma_simplegrid_offsetsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_offsetrightsettings'])) {
            $arrOffsetRightSettings = deserialize($arrRow['dma_simplegrid_offsetrightsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_pushsettings'])) {
            $arrPushSettings = deserialize($arrRow['dma_simplegrid_pushsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_pullsettings'])) {
            $arrPullSettings = deserialize($arrRow['dma_simplegrid_pullsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalcolumnclasses'])) {
            $arrAdditionalColumnClassesSettings = deserialize($arrRow['dma_simplegrid_additionalcolumnclasses'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalrowclasses'])) {
            $arrAdditionalRowClassesSettings = deserialize($arrRow['dma_simplegrid_additionalrowclasses'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalwrapperclasses'])) {
            $arrAdditionalWrapperClassesSettings = deserialize($arrRow['dma_simplegrid_additionalwrapperclasses'], true);
        }

        if (sizeof($arrColumnSettings) == 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . ": " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrOffsetSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset']) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrOffsetRightSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight']) {
            $arrElementSettings = $arrOffsetRightSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset-right: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPushSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush']) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-push: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPullSettings) == 1 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull']) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-pull: " . $varValue;
                    }
                }
            }
        }

        if (sizeof($arrAdditionalColumnClassesSettings) > 0 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'])
        {
            if (is_array($arrAdditionalColumnClassesSettings))
            {
                foreach ($arrAdditionalColumnClassesSettings as $varValue)
                {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (sizeof($arrAdditionalRowClassesSettings) > 0 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'])
        {
            if (is_array($arrAdditionalRowClassesSettings))
            {
                foreach ($arrAdditionalRowClassesSettings as $varValue)
                {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (sizeof($arrAdditionalWrapperClassesSettings) > 0 && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'])
        {
            if (is_array($arrAdditionalWrapperClassesSettings))
            {
                foreach ($arrAdditionalWrapperClassesSettings as $varValue)
                {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }





        $strReturn = implode('; ', $arrConfiguredClasses);

        return $strReturn;

    }

    private static function initialize()
    {

        if ($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] && $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']])
        {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }
    }

}