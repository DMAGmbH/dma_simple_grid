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
            if (isset($arrTemplateData[$checkableKey]) && $arrTemplateData[$checkableKey])
            {
                $blnHasDmaGridInfos = true;
            }
        }

        return $blnHasDmaGridInfos;

    }

    public static function getColumnClasses($arrTemplateData)
    {

		if (isset($arrTemplateData['origId']) && $arrTemplateData['origId'] && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOwnSettingsByIncludeElements'] ?? false))
		{
			// includiertes Inhaltselement
			$origContentElement = \ContentModel::findById($arrTemplateData['id']);
			if ($origContentElement !== null)
			{
				$arrTemplateData = $origContentElement->row();
			}
		}

        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $arrConfiguredClasses = array();

        if (isset($arrTemplateData['dma_simplegrid_columnsettings']) && !is_array($arrTemplateData['dma_simplegrid_columnsettings'])) {
            $arrColumnSettings = deserialize($arrTemplateData['dma_simplegrid_columnsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_offsetsettings']) && !is_array($arrTemplateData['dma_simplegrid_offsetsettings'])) {
            $arrOffsetSettings = deserialize($arrTemplateData['dma_simplegrid_offsetsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_offsetrightsettings']) && !is_array($arrTemplateData['dma_simplegrid_offsetrightsettings'])) {
            $arrOffsetRightSettings = deserialize($arrTemplateData['dma_simplegrid_offsetrightsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_pushsettings']) && !is_array($arrTemplateData['dma_simplegrid_pushsettings'])) {
            $arrPushSettings = deserialize($arrTemplateData['dma_simplegrid_pushsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_pullsettings']) && !is_array($arrTemplateData['dma_simplegrid_pullsettings'])) {
            $arrPullSettings = deserialize($arrTemplateData['dma_simplegrid_pullsettings'], true);
        }

        if (isset($arrColumnSettings) && sizeof($arrColumnSettings) == 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        if ($varValue === 'hide') {
                            $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['hide-class'];
                        } else {
                            $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['column-class'], $varValue);
                        }
                    }
                }
            }
        }

        if (isset($arrOffsetSettings) && sizeof($arrOffsetSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue === 'reset' && isset(static::$arrCache['grid']['config']['hasColumnOffsetReset']) && static::$arrCache['grid']['config']['hasColumnOffsetReset']) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrOffsetRightSettings) && sizeof($arrOffsetRightSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $arrElementSettings = $arrOffsetRightSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue === 'reset' && isset(static::$arrCache['grid']['config']['hasColumnOffsetRightReset']) && static::$arrCache['grid']['config']['hasColumnOffsetRightReset']) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-right-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['offset-right-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrPushSettings) && sizeof($arrPushSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue === 'reset' && isset(static::$arrCache['grid']['config']['hasColumnPushReset']) && static::$arrCache['grid']['config']['hasColumnPushReset']) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['push-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['push-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrPullSettings) && sizeof($arrPullSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue === 'reset' && isset(static::$arrCache['grid']['config']['hasColumnPullReset']) && static::$arrCache['grid']['config']['hasColumnPullReset']) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['pull-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf(static::$arrCache['grid']['config']['columns-config'][$columnKey]['pull-class'], $varValue);
                    }
                }
            }
        }

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false) && static::$arrCache['grid']['config']['additional-classes']['columns'])
        {
            $arrAdditionalClasses = isset($arrTemplateData['dma_simplegrid_additionalcolumnclasses']) ? deserialize($arrTemplateData['dma_simplegrid_additionalcolumnclasses'], true) : [];

            if (sizeof($arrAdditionalClasses) > 0)
            {
                foreach ($arrAdditionalClasses as $strClassKey)
                {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if (sizeof($arrConfiguredClasses) > 0 || (isset($arrTemplateData['type']) && $arrTemplateData['type']=="dma_simplegrid_column_start")) {
            if (isset(static::$arrCache['grid']['config']['column-class']) && static::$arrCache['grid']['config']['column-class'])
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

    public static function columnsSelectCallback(\Widget $widget = null)
    {
        if (!isset(static::$arrCache['grid']))
        {
            self::initialize();
        }

        $arrColumnsSetting = array();

        if (static::$arrCache['grid']['config']['columns-config']) {
            foreach (static::$arrCache['grid']['config']['columns-config'] as $configName => $arrColumnConfig) {
                $options = [];

                // Add the hide option for column settings
                if ($widget !== null && $widget->dataContainer->field === 'dma_simplegrid_columnsettings' && isset($arrColumnConfig['hide-class'])) {
                    $options['hide'] = &$GLOBALS['TL_LANG']['MSC']['dma_simplegrid_hidden'];
                }

                // Add the reset/zero option for offset/offset-right/push/pull settings
                if ($widget !== null && (
                    ($widget->dataContainer->field === 'dma_simplegrid_offsetsettings' && isset(static::$arrCache['grid']['config']['hasColumnOffsetReset']) && static::$arrCache['grid']['config']['hasColumnOffsetReset'])
                    || ($widget->dataContainer->field === 'dma_simplegrid_offsetrightsettings' && isset(static::$arrCache['grid']['config']['hasColumnOffsetRightReset']) && static::$arrCache['grid']['config']['hasColumnOffsetRightReset'])
                    || ($widget->dataContainer->field === 'dma_simplegrid_pushsettings' && isset(static::$arrCache['grid']['config']['hasColumnPushReset']) && static::$arrCache['grid']['config']['hasColumnPushReset'])
                    || ($widget->dataContainer->field === 'dma_simplegrid_pullsettings' && isset(static::$arrCache['grid']['config']['hasColumnPullReset']) && static::$arrCache['grid']['config']['hasColumnPullReset'])
                )) {
                    $options['reset'] = '0 (reset)';
                }

                // Add the column sizes
                foreach (static::$arrCache['grid']['config']['columns-sizes'] as $column) {
                    $options[$column] = $column;
                }

                $arrColumnsSetting[$configName] = array
                (
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => $options,
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

        if (!is_array($arrRow['dma_simplegrid_columnsettings'] ?? null)) {
            $arrColumnSettings = deserialize($arrRow['dma_simplegrid_columnsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_offsetsettings'] ?? null)) {
            $arrOffsetSettings = deserialize($arrRow['dma_simplegrid_offsetsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_offsetrightsettings'] ?? null)) {
            $arrOffsetRightSettings = deserialize($arrRow['dma_simplegrid_offsetrightsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_pushsettings'] ?? null)) {
            $arrPushSettings = deserialize($arrRow['dma_simplegrid_pushsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_pullsettings'] ?? null)) {
            $arrPullSettings = deserialize($arrRow['dma_simplegrid_pullsettings'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalcolumnclasses'] ?? null)) {
            $arrAdditionalColumnClassesSettings = deserialize($arrRow['dma_simplegrid_additionalcolumnclasses'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalrowclasses'] ?? null)) {
            $arrAdditionalRowClassesSettings = deserialize($arrRow['dma_simplegrid_additionalrowclasses'], true);
        }
        if (!is_array($arrRow['dma_simplegrid_additionalwrapperclasses'] ?? null)) {
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
        if (sizeof($arrOffsetSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrOffsetRightSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $arrElementSettings = $arrOffsetRightSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset-right: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPushSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-push: " . $varValue;
                    }
                }
            }
        }
        if (sizeof($arrPullSettings) == 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-pull: " . $varValue;
                    }
                }
            }
        }

        if (sizeof($arrAdditionalColumnClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false))
        {
            if (is_array($arrAdditionalColumnClassesSettings))
            {
                foreach ($arrAdditionalColumnClassesSettings as $varValue)
                {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (sizeof($arrAdditionalRowClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false))
        {
            if (is_array($arrAdditionalRowClassesSettings))
            {
                foreach ($arrAdditionalRowClassesSettings as $varValue)
                {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (sizeof($arrAdditionalWrapperClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false))
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

        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false))
        {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        }
        else
        {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_CONFIG']['DMA_SIMPLEGRID_FALLBACK']];
        }
    }

}
