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

namespace Dma\DmaSimpleGrid\DataContainer;

use Contao\ArrayUtil;
use Contao\ContentModel;
use Contao\StringUtil;
use Dma\DmaSimpleGrid\Config\GridConfig;

/**
 * DMA SimpleGrid DCA (tl_content and tl_module).
 *
 * Provide miscellaneous methods that are used by the data configuration arrays.
 */
class DcaUtil
{
    public static function hasDmaGridInfos($arrTemplateData): bool
    {
        $arrCheckableKeys = [
            'dma_simplegrid_columnsettings',
            'dma_simplegrid_offsetsettings',
            'dma_simplegrid_offsetrightsettings',
            'dma_simplegrid_pushsettings',
            'dma_simplegrid_pullsettings',
        ];

        $blnHasDmaGridInfos = false;

        foreach ($arrCheckableKeys as $checkableKey) {
            if (isset($arrTemplateData[$checkableKey]) && $arrTemplateData[$checkableKey]) {
                $blnHasDmaGridInfos = true;
            }
        }

        return $blnHasDmaGridInfos;
    }

    public static function getColumnClasses(array $arrTemplateData): string
    {
        if (isset($arrTemplateData['origId']) && $arrTemplateData['origId'] && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOwnSettingsByIncludeElements'] ?? false)) {
            // included content element
            $origContentElement = ContentModel::findById($arrTemplateData['id']);

            if (null !== $origContentElement) {
                $arrTemplateData = $origContentElement->row();
            }
        }

        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        $arrConfiguredClasses = [];

        if (isset($arrTemplateData['dma_simplegrid_columnsettings']) && !\is_array($arrTemplateData['dma_simplegrid_columnsettings'])) {
            $arrColumnSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_columnsettings'], true);
        }

        if (isset($arrTemplateData['dma_simplegrid_offsetsettings']) && !\is_array($arrTemplateData['dma_simplegrid_offsetsettings'])) {
            $arrOffsetSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_offsetsettings'], true);
        }

        if (isset($arrTemplateData['dma_simplegrid_offsetrightsettings']) && !\is_array($arrTemplateData['dma_simplegrid_offsetrightsettings'])) {
            $arrOffsetRightSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_offsetrightsettings'], true);
        }

        if (isset($arrTemplateData['dma_simplegrid_pushsettings']) && !\is_array($arrTemplateData['dma_simplegrid_pushsettings'])) {
            $arrPushSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_pushsettings'], true);
        }

        if (isset($arrTemplateData['dma_simplegrid_pullsettings']) && !\is_array($arrTemplateData['dma_simplegrid_pullsettings'])) {
            $arrPullSettings = StringUtil::deserialize($arrTemplateData['dma_simplegrid_pullsettings'], true);
        }

        if (isset($arrColumnSettings) && 1 === \count($arrColumnSettings)) {
            $arrElementSettings = $arrColumnSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue) {
                        if ('hide' === $varValue) {
                            $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['hide-class'];
                        } else {
                            $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['column-class'], $varValue);
                        }
                    }
                }
            }
        }

        if (isset($arrOffsetSettings) && 1 === \count($arrOffsetSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $arrElementSettings = $arrOffsetSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ('reset' === $varValue && isset($gridConfig['hasColumnOffsetReset']) && $gridConfig['hasColumnOffsetReset']) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['offset-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['offset-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrOffsetRightSettings) && 1 === \count($arrOffsetRightSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $arrElementSettings = $arrOffsetRightSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ('reset' === $varValue && isset($gridConfig['hasColumnOffsetRightReset']) && $gridConfig['hasColumnOffsetRightReset']) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['offset-right-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['offset-right-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrPushSettings) && 1 === \count($arrPushSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $arrElementSettings = $arrPushSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ('reset' === $varValue && isset($gridConfig['hasColumnPushReset']) && $gridConfig['hasColumnPushReset']) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['push-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['push-class'], $varValue);
                    }
                }
            }
        }

        if (isset($arrPullSettings) && 1 === \count($arrPullSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $arrElementSettings = $arrPullSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ('reset' === $varValue && isset($gridConfig['hasColumnPullReset']) && $gridConfig['hasColumnPullReset']) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['pull-class'], 0);
                    } elseif ($varValue) {
                        $arrConfiguredClasses[] = sprintf($gridConfig['columns-config'][$columnKey]['pull-class'], $varValue);
                    }
                }
            }
        }

        if (
            isset($gridConfig['additional-classes']['columns']) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false)
        ) {
            $arrAdditionalClasses = isset($arrTemplateData['dma_simplegrid_additionalcolumnclasses']) ? StringUtil::deserialize($arrTemplateData['dma_simplegrid_additionalcolumnclasses'], true) : [];

            if (\count($arrAdditionalClasses) > 0) {
                foreach ($arrAdditionalClasses as $strClassKey) {
                    $arrConfiguredClasses[] = $strClassKey;
                }
            }
        }

        if (\count($arrConfiguredClasses) > 0 || (isset($arrTemplateData['type']) && 'dma_simplegrid_column_start' === $arrTemplateData['type'])) {
            if (isset($gridConfig['column-class']) && $gridConfig['column-class']) {
                ArrayUtil::arrayInsert($arrConfiguredClasses, 0, $gridConfig['column-class']);
            }
        }

        $strClasses = implode(' ', $arrConfiguredClasses);

        if (str_contains($strClasses, '^')) {
            $strClasses = str_replace(' ^', '', $strClasses);
        }

        return $strClasses;
    }

    public static function getColumnsShowString(array $arrRow): string
    {
        $arrConfiguredClasses = [];

        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        if (!\is_array($arrRow['dma_simplegrid_columnsettings'] ?? null)) {
            $arrColumnSettings = isset($arrRow['dma_simplegrid_columnsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_columnsettings'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_offsetsettings'] ?? null)) {
            $arrOffsetSettings = isset($arrRow['dma_simplegrid_offsetsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_offsetsettings'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_offsetrightsettings'] ?? null)) {
            $arrOffsetRightSettings = isset($arrRow['dma_simplegrid_offsetrightsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_offsetrightsettings'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_pushsettings'] ?? null)) {
            $arrPushSettings = isset($arrRow['dma_simplegrid_pushsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_pushsettings'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_pullsettings'] ?? null)) {
            $arrPullSettings = isset($arrRow['dma_simplegrid_pullsettings']) ? StringUtil::deserialize($arrRow['dma_simplegrid_pullsettings'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_additionalcolumnclasses'] ?? null)) {
            $arrAdditionalColumnClassesSettings = isset($arrRow['dma_simplegrid_additionalcolumnclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalcolumnclasses'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_additionalrowclasses'] ?? null)) {
            $arrAdditionalRowClassesSettings = isset($arrRow['dma_simplegrid_additionalrowclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalrowclasses'], true) : [];
        }

        if (!\is_array($arrRow['dma_simplegrid_additionalwrapperclasses'] ?? null)) {
            $arrAdditionalWrapperClassesSettings = isset($arrRow['dma_simplegrid_additionalwrapperclasses']) ? StringUtil::deserialize($arrRow['dma_simplegrid_additionalwrapperclasses'], true) : [];
        }

        if (isset($arrColumnSettings) && 1 === \count($arrColumnSettings)) {
            $arrElementSettings = $arrColumnSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && $gridConfig['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['name'].': '.$varValue;
                    }
                }
            }
        }

        if (isset($arrOffsetSettings) && 1 === \count($arrOffsetSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $arrElementSettings = $arrOffsetSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && $gridConfig['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['name'].'-offset: '.$varValue;
                    }
                }
            }
        }

        if (isset($arrOffsetRightSettings) && 1 === \count($arrOffsetRightSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $arrElementSettings = $arrOffsetRightSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && $gridConfig['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['name'].'-offset-right: '.$varValue;
                    }
                }
            }
        }

        if (isset($arrPushSettings) && 1 === \count($arrPushSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $arrElementSettings = $arrPushSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && $gridConfig['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['name'].'-push: '.$varValue;
                    }
                }
            }
        }

        if (isset($arrPullSettings) && 1 === \count($arrPullSettings) && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $arrElementSettings = $arrPullSettings[0];

            if (\is_array($arrElementSettings)) {
                foreach ($arrElementSettings as $columnKey => $varValue) {
                    if ($varValue && $gridConfig['columns-config'][$columnKey]['name']) {
                        $arrConfiguredClasses[] = $gridConfig['columns-config'][$columnKey]['name'].'-pull: '.$varValue;
                    }
                }
            }
        }

        if (isset($arrAdditionalColumnClassesSettings) && \count($arrAdditionalColumnClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false)) {
            if (\is_array($arrAdditionalColumnClassesSettings)) {
                foreach ($arrAdditionalColumnClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (isset($arrAdditionalRowClassesSettings) && \count($arrAdditionalRowClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false)) {
            if (\is_array($arrAdditionalRowClassesSettings)) {
                foreach ($arrAdditionalRowClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        if (isset($arrAdditionalWrapperClassesSettings) && \count($arrAdditionalWrapperClassesSettings) > 0 && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false)) {
            if (\is_array($arrAdditionalWrapperClassesSettings)) {
                foreach ($arrAdditionalWrapperClassesSettings as $varValue) {
                    $arrConfiguredClasses[] = $varValue;
                }
            }
        }

        return implode('; ', $arrConfiguredClasses);
    }
}
