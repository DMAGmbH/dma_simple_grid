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

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\Widget;
use Dma\DmaSimpleGrid\Config\GridConfig;

/**
 * DMA SimpleGrid DCA (tl_content and tl_module).
 *
 * Provide miscellaneous methods that are used by the data configuration arrays.
 */
class AcrossTablesDcaCallbacks
{
    private array $arrConfigData;

    public function __construct()
    {
        if (($GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? false) && ($GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType'] ?? null] ?? false)) {
            $this->arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['TL_CONFIG']['dmaSimpleGridType']];
        } else {
            $this->arrConfigData = $GLOBALS['DMA_SIMPLEGRID_CONFIG'][$GLOBALS['DMA_SIMPLEGRID_FALLBACK']];
        }
    }

    #[AsCallback(table: 'tl_form_field', target: 'config.onload')]
    #[AsCallback(table: 'tl_content', target: 'config.onload')]
    public function adjustPalettesString(DataContainer $dc): void
    {
        $fieldsToAppend = [];

        if (GridConfig::getData('hasColumns') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useColumns'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_columnsettings';
        }

        if (GridConfig::getData('hasColumnOffset') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffset'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_offsetsettings';
        }

        if (GridConfig::getData('hasColumnOffsetRight') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useOffsetRight'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_offsetrightsettings';
        }

        if (GridConfig::getData('hasColumnPull') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePush'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_pullsettings';
        }

        if (GridConfig::getData('hasColumnPush') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_usePull'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_pushsettings';
        }

        if (GridConfig::getData('hasColumnClasses') && ($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalColumnClasses'] ?? false)) {
            $fieldsToAppend[] = 'dma_simplegrid_additionalcolumnclasses';
        }

        if ('tl_content' === $dc->table) {
            if (!GridConfig::getData('hasRows')) {
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_start'], $GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_row_stop']);
            }

            if (!GridConfig::getData('hasWrapper')) {
                unset($GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_start'], $GLOBALS['TL_CTE']['dma_simplegrid']['dma_simplegrid_wrapper_stop']);
            }

            $arrNotSupportedOrUsefulElements = ['module', 'dma_simplegrid_row_start', 'dma_simplegrid_wrapper_start'];

            foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $palette) {
                $fieldsToAppendCurrentLoop = $fieldsToAppend;

                if (!\is_array($palette) && str_contains($palette, 'cssID') && !\in_array($k, $arrNotSupportedOrUsefulElements, true)) {
                    PaletteManipulator::create()
                        ->addLegend('dma_simplegrid_legend', 'invisible_legend', PaletteManipulator::POSITION_BEFORE)
                        ->addField($fieldsToAppendCurrentLoop, 'dma_simplegrid_legend', PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($k, 'tl_content')
                    ;
                }

                if ('dma_simplegrid_row_start' === $k) {
                    $rowStartFields = [];

                    if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useBlockGrid'] ?? false) && GridConfig::getData('hasBlockGrid')) {
                        $rowStartFields[] = 'dma_simplegrid_blocksettings';
                    }

                    if (
                        isset($this->arrConfigData['config']['additional-classes']['row']) && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false
                    ) {
                        $rowStartFields[] = 'dma_simplegrid_additionalrowclasses';
                    }

                    if (!empty($rowStartFields)) {
                        PaletteManipulator::create()
                            ->addLegend('dma_simplegrid_legend', 'invisible_legend', PaletteManipulator::POSITION_BEFORE)
                            ->addField($rowStartFields, 'dma_simplegrid_legend', PaletteManipulator::POSITION_APPEND)
                            ->applyToPalette($k, 'tl_content')
                        ;
                    }
                }

                if ('dma_simplegrid_wrapper_start' === $k) {
                    if (
                        isset($this->arrConfigData['config']['additional-classes']['wrapper']) && $GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalWrapperClasses'] ?? false
                    ) {
                        PaletteManipulator::create()
                            ->addLegend('dma_simplegrid_legend', 'invisible_legend', PaletteManipulator::POSITION_BEFORE)
                            ->addField('dma_simplegrid_additionalwrapperclasses', 'dma_simplegrid_legend', PaletteManipulator::POSITION_APPEND)
                            ->applyToPalette($k, 'tl_content')
                        ;
                    }
                }
            }
        }

        if ('tl_form_field' === $dc->table) {
            foreach ($GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $k => $palette) {
                $fieldsToAppendCurrentLoop = $fieldsToAppend;

                if (!\is_array($palette) && str_contains($palette, 'class')) {
                    if ('dma_simplegrid_row_start' === $k) {
                        if (($GLOBALS['TL_CONFIG']['dmaSimpleGrid_useAdditionalRowClasses'] ?? false) && $this->arrConfigData['config']['additional-classes']['row']) {
                            $fieldsToAppendCurrentLoop[] = 'dma_simplegrid_additionalrowclasses';
                        }
                    }

                    PaletteManipulator::create()
                        ->addLegend('dma_simplegrid_legend', 'template_legend', PaletteManipulator::POSITION_BEFORE)
                        ->addField($fieldsToAppendCurrentLoop, 'dma_simplegrid_legend', PaletteManipulator::POSITION_APPEND)
                        ->applyToPalette($k, 'tl_form_field')
                    ;
                }
            }
        }
    }

    #[AsCallback(table: 'tl_form_field', target: 'list.operations.show_simplegrid_infos.button')]
    #[AsCallback(table: 'tl_content', target: 'list.operations.show_simplegrid_infos.button')]
    public function getSimpleGridInfos(array $arrRow): string
    {
        $strGridInfo = '';

        if (($arrRow['dma_simplegrid_columnsettings'] ?? false) || ($arrRow['dma_simplegrid_additionalwrapperclasses'] ?? false)) {
            $strGridInfo .= DcaUtil::getColumnsShowString($arrRow);
        }

        if ('' !== $strGridInfo) {
            $strGridInfo = '<a href="#" class="tl_gray" style="padding-right:10px; white-space:nowrap; max-width:200px; display:inline-block; overflow:hidden; text-overflow:ellipsis;" title="'.$strGridInfo.'" onclick="return false;">'.$strGridInfo.'</a>';
        }

        return $strGridInfo;
    }

    public function columnsSelectCallback(Widget $widget = null): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        $arrColumnsSetting = [];

        if ($gridConfig['columns-config']) {
            foreach ($gridConfig['columns-config'] as $configName => $arrColumnConfig) {
                $options = [];

                // Add the hide option for column settings
                if (null !== $widget && 'dma_simplegrid_columnsettings' === $widget->dataContainer->field && isset($arrColumnConfig['hide-class'])) {
                    $options['hide'] = &$GLOBALS['TL_LANG']['MSC']['dma_simplegrid_hidden'];
                }

                // Add the reset/zero option for offset/offset-right/push/pull settings
                if (
                    null !== $widget && (
                        ('dma_simplegrid_offsetsettings' === $widget->dataContainer->field && isset($gridConfig['hasColumnOffsetReset']) && $gridConfig['hasColumnOffsetReset'])
                        || ('dma_simplegrid_offsetrightsettings' === $widget->dataContainer->field && isset($gridConfig['hasColumnOffsetRightReset']) && $gridConfig['hasColumnOffsetRightReset'])
                        || ('dma_simplegrid_pushsettings' === $widget->dataContainer->field && isset($gridConfig['hasColumnPushReset']) && $gridConfig['hasColumnPushReset'])
                        || ('dma_simplegrid_pullsettings' === $widget->dataContainer->field && isset($gridConfig['hasColumnPullReset']) && $gridConfig['hasColumnPullReset'])
                    )
                ) {
                    $options['reset'] = '0 (reset)';
                }

                // Add the column sizes
                foreach ($gridConfig['columns-sizes'] as $column) {
                    $options[$column] = $column;
                }

                $arrColumnsSetting[$configName] = [
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => $options,
                    'eval' => ['includeBlankOption' => true, 'style' => 'width:115px'],
                ];
            }
        }

        return $arrColumnsSetting;
    }

    public static function blockSelectCallback(): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        $arrColumnsSetting = [];

        if ($gridConfig['block-config']) {
            foreach ($gridConfig['block-config'] as $configName => $arrColumnConfig) {
                $arrColumnsSetting[$configName] = [
                    'label' => $arrColumnConfig['name'],
                    'inputType' => 'select',
                    'options' => $gridConfig['block-sizes'],
                    'eval' => ['includeBlankOption' => true, 'style' => 'width:115px'],
                ];
            }
        }

        return $arrColumnsSetting;
    }
}
