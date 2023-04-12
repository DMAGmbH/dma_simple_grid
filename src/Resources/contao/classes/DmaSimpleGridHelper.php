<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DMA;

use Contao\Controller;

/**
 * DMA SimpleGrid Helper
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class DmaSimpleGridHelper extends Controller
{

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
        $tableless = version_compare(VERSION, '4.0', '>=') ? true : $objForm->tableless;

        if ($tableless && ($objWidget->dma_simplegrid_columnsettings || $objWidget->dma_simplegrid_offsetsettings || $objWidget->dma_simplegrid_pushsettings || $objWidget->dma_simplegrid_pullsettings))
        {

            $strWidgetClasses = "";

            $arrTemplateData = array
            (
                'dma_simplegrid_columnsettings' => $objWidget->dma_simplegrid_columnsettings,
                'dma_simplegrid_offsetsettings' => $objWidget->dma_simplegrid_offsetsettings,
                'dma_simplegrid_pushsettings' => $objWidget->dma_simplegrid_pushsettings,
                'dma_simplegrid_pullsettings' => $objWidget->dma_simplegrid_pullsettings
            );

            $strWidgetClasses .= ($strWidgetClasses != "" ? " " : "") . DmaSimpleGrid::getColumnClasses($arrTemplateData);

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
        if (DmaSimpleGrid::hasDmaGridInfos($objTemplate->getData()))
        {
            $objTemplate->class .= " " . DmaSimpleGrid::getColumnClasses($objTemplate->getData());
        }

    }

}
