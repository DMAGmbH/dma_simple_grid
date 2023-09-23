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

namespace Dma\DmaSimpleGrid\EventListener\ContaoHook;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;
use Contao\Widget;
use Dma\DmaSimpleGrid\DataContainer\DcaUtil;

#[AsHook('loadFormField', priority: 100)]
class LoadFormFieldListener
{
    public function __invoke(Widget $widget, string $formId, array $formData, Form $form): Widget
    {
        if ($widget->dma_simplegrid_columnsettings || $widget->dma_simplegrid_offsetsettings || $widget->dma_simplegrid_pushsettings || $widget->dma_simplegrid_pullsettings) {
            $arrTemplateData = [
                'dma_simplegrid_columnsettings' => $widget->dma_simplegrid_columnsettings,
                'dma_simplegrid_offsetsettings' => $widget->dma_simplegrid_offsetsettings,
                'dma_simplegrid_pushsettings' => $widget->dma_simplegrid_pushsettings,
                'dma_simplegrid_pullsettings' => $widget->dma_simplegrid_pullsettings,
            ];

            $strWidgetClasses = DcaUtil::getColumnClasses($arrTemplateData);

            if ('' !== $widget->__get('prefix')) {
                $strWidgetClasses = ' '.$strWidgetClasses;
            }

            $widget->__set('prefix', $widget->__get('prefix').$strWidgetClasses);
        }

        return $widget;
    }
}
