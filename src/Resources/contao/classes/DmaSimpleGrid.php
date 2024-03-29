<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DMA;

use Contao\ArrayUtil;
use Contao\ContentModel;
use Contao\StringUtil;
use Contao\Widget;

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
     */
    protected static $objInstance;

    /**
     * Cache
     * @var array
     */
    protected static array $arrCache = [];

    public static function getData()
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        return static::$arrCache['grid'];
    }

    public static function getConfigData($strKey)
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        return static::$arrCache['grid']['config'][$strKey] ?? false;
    }

    public static function hasDmaGridInfos($arrTemplateData): bool
    {
        $arrCheckableKeys = [
            'dma_simplegrid_columnsettings',
            'dma_simplegrid_offsetsettings',
            'dma_simplegrid_offsetrightsettings',
            'dma_simplegrid_pushsettings',
            'dma_simplegrid_pullsettings'
        ];

        $blnHasDmaGridInfos = false;

        foreach ($arrCheckableKeys as $checkableKey) {
            if (isset($arrTemplateData[$checkableKey]) && $arrTemplateData[$checkableKey]) {
                $blnHasDmaGridInfos = true;
            }
        }

        return $blnHasDmaGridInfos;
    }

    public static function getColumnClasses($arrTemplateData): string
    {
		if (isset($arrTemplateData['origId']) && $arrTemplateData['origId'] && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOwnSettingsByIncludeElements'] ?? false)) {
			// includiertes Inhaltselement
			$origContentElement = ContentModel::findById($arrTemplateData['id']);
			if ($origContentElement !== null) {
				$arrTemplateData = $origContentElement->row();
			}
		}

        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        $arrConfiguredClasses = [];

        if (isset($arrTemplateData['dma_simplegrid_columnsettings']) && !is_array($arrTemplateData['dma_simplegrid_columnsettings'])) {
            $arrColumnSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_columnsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_offsetsettings']) && !is_array($arrTemplateData['dma_simplegrid_offsetsettings'])) {
            $arrOffsetSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_offsetsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_offsetrightsettings']) && !is_array($arrTemplateData['dma_simplegrid_offsetrightsettings'])) {
            $arrOffsetRightSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_offsetrightsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_pushsettings']) && !is_array($arrTemplateData['dma_simplegrid_pushsettings'])) {
            $arrPushSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_pushsettings'], true);
        }
        if (isset($arrTemplateData['dma_simplegrid_pullsettings']) && !is_array($arrTemplateData['dma_simplegrid_pullsettings'])) {
            $arrPullSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_pullsettings'], true);
        }

        if (isset($arrColumnSettings) && count($arrColumnSettings) === 1) {
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

        if (isset($arrOffsetSettings) && count($arrOffsetSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
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

        if (isset($arrOffsetRightSettings) && count($arrOffsetRightSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
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

        if (isset($arrPushSettings) && count($arrPushSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
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

        if (isset($arrPullSettings) && count($arrPullSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
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

        if (isset(static::$arrCache['grid']['config']['additional-classes']['columns']) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false)) {
            $arrAdditionalClasses = isset($arrTemplateData['dma_simplegrid_additionalcolumnclasses']) ? StringUtil::deserialize($arrTemplateData['dma_simplegrid_additionalcolumnclasses'], true) : [];
            if (count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if (count($arrConfiguredClasses) > 0 || (isset($arrTemplateData['type']) && $arrTemplateData['type'] === 'dma_simplegrid_column_start')) {
            if (isset(static::$arrCache['grid']['config']['column-class']) && static::$arrCache['grid']['config']['column-class']) {
                ArrayUtil::arrayInsert($arrConfiguredClasses, 0, static::$arrCache['grid']['config']['column-class']);
            }
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        if (str_contains($strClasses, '^')) {
            $strClasses = str_replace(' ^', '', $strClasses);
        }

        return (string) $strClasses;
    }



    public static function getSimpleGridInfos($arrRow): string
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        $strGridInfo = '';

        if (($arrRow['dma_simplegrid_columnsettings'] ?? false) || ($arrRow['dma_simplegrid_additionalwrapperclasses'] ?? false)) {
            $strGridInfo .= self::getColumnsShowString($arrRow);
        }

        if ($strGridInfo !== '') {
            $strGridInfo = '<a href="#" class="tl_gray" style="padding-right:10px; white-space:nowrap; max-width:200px; display:inline-block; overflow:hidden; text-overflow:ellipsis;" title="' . $strGridInfo .'" onclick="return false;">' . $strGridInfo . '</a>';
        }

        return $strGridInfo;
    }

    public static function blockSelectCallback(): array
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        $arrColumnsSetting = [];

        if (static::$arrCache['grid']['config']['block-config']) {
            foreach (static::$arrCache['grid']['config']['block-config'] as $configName => $arrColumnConfig) {
                $arrColumnsSetting[$configName] = [
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => static::$arrCache['grid']['config']['block-sizes'],
                    'eval' => ['includeBlankOption' => true, 'style' => 'width:115px']
                ];
            }
        }

        return $arrColumnsSetting;
    }

    public static function columnsSelectCallback(Widget $widget = null): array
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        $arrColumnsSetting = [];

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

                $arrColumnsSetting[$configName] = [
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => $options,
                    'eval' => ['includeBlankOption' => true, 'style' => 'width:115px']
                ];
            }
        }

        return $arrColumnsSetting;
    }

    public static function getAdditionalWrapperClasses()
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['wrapper'];
    }

    public static function getAdditionalRowClasses()
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['row'];
    }

    public static function getAdditionalColumnClasses()
    {
        if (!isset(static::$arrCache['grid'])) {
            self::initialize();
        }

        return static::$arrCache['grid']['config']['additional-classes']['columns'];
    }

    public static function getColumnsShowString($arrRow): string
    {
        $arrConfiguredClasses = [];

        if (!is_array($arrRow['dma_simplegrid_columnsettings'] ?? null)) {
            $arrColumnSettings = isset($arrRow['dma_simplegrid_columnsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_columnsettings'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_offsetsettings'] ?? null)) {
            $arrOffsetSettings = isset($arrRow['dma_simplegrid_offsetsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_offsetsettings'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_offsetrightsettings'] ?? null)) {
            $arrOffsetRightSettings = isset($arrRow['dma_simplegrid_offsetrightsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_offsetrightsettings'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_pushsettings'] ?? null)) {
            $arrPushSettings = isset($arrRow['dma_simplegrid_pushsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_pushsettings'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_pullsettings'] ?? null)) {
            $arrPullSettings = isset($arrRow['dma_simplegrid_pullsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_pullsettings'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_additionalcolumnclasses'] ?? null)) {
            $arrAdditionalColumnClassesSettings = isset($arrRow['dma_simplegrid_additionalcolumnclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalcolumnclasses'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_additionalrowclasses'] ?? null)) {
            $arrAdditionalRowClassesSettings = isset($arrRow['dma_simplegrid_additionalrowclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalrowclasses'], true) : [];
        }
        if (!is_array($arrRow['dma_simplegrid_additionalwrapperclasses'] ?? null)) {
            $arrAdditionalWrapperClassesSettings = isset($arrRow['dma_simplegrid_additionalwrapperclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalwrapperclasses'], true) : [];
        }

        if (count($arrColumnSettings) === 1) {
            $arrElementSettings = $arrColumnSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . ": " . $varValue;
                    }
                }
            }
        }

        if (count($arrOffsetSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $arrElementSettings = $arrOffsetSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset: " . $varValue;
                    }
                }
            }
        }

        if (count($arrOffsetRightSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $arrElementSettings = $arrOffsetRightSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-offset-right: " . $varValue;
                    }
                }
            }
        }

        if (count($arrPushSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $arrElementSettings = $arrPushSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-push: " . $varValue;
                    }
                }
            }
        }

        if (count($arrPullSettings) === 1 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $arrElementSettings = $arrPullSettings[0];
            if (is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && static::$arrCache['grid']['config']['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = static::$arrCache['grid']['config']['columns-config'][$columnKey]['name'] . "-pull: " . $varValue;
                    }
                }
            }
        }

        if (count($arrAdditionalColumnClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false))
        {
            if (is_array($arrAdditionalColumnClassesSettings)) {
                foreach ($arrAdditionalColumnClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (count($arrAdditionalRowClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false))
        {
            if (is_array($arrAdditionalRowClassesSettings)) {
                foreach ($arrAdditionalRowClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (count($arrAdditionalWrapperClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false))
        {
            if (is_array($arrAdditionalWrapperClassesSettings)) {
                foreach ($arrAdditionalWrapperClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        return implode('; ', $arrConfiguredClasses);
    }

    private static function initialize(): void
    {
        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null)] ?? false)) {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            static::$arrCache['grid'] = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_FALLBACK']];
        }
    }

}
